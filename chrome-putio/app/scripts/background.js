'use strict';

var playback_rate = 0;
var info_keys = [];
var globals = {};

var setNowPlayingData = function(link, metaInfo, playback) {
  var nowPlaying = {
    link: link,
    metaInfo: metaInfo,
    playback: playback
  };
  console.log(nowPlaying);

  chrome.storage.local.set({
    nowPlaying: nowPlaying
  }, function() {
  });
};

var aCheck = function(link){
  var xhr = new XMLHttpRequest();

  xhr.open("HEAD", link, true);
  xhr.addEventListener("load", function(progress) {
    var link = progress.target.responseURL;
    aPlay(link);
  });

  xhr.send(null);
};


var aPause = function(hostname, port){

  var xhr_pause = new XMLHttpRequest();

  xhr_pause.open("POST", "http://" + hostname + port + "/rate?value=0.000000", true, "AirPlay", null);
  xhr_pause.addEventListener("load", function() {
  });

  xhr_pause.send(null);

};

var aPlay = function(url, position){

  var position = typeof position !== 'undefined' ? position : 0,
      xhr = new XMLHttpRequest(),
      xhr_stop = new XMLHttpRequest(),
      hostname = "apple-tv.local",
      port = ":7000",
      timeout = 20000,
      timer,
      playback_started = false,
      url_loaded = false,
      terminate_loop = false,
      playback_paused = false;

  xhr_stop.open("POST", "http://" + hostname + port + "/stop", true, "AirPlay", null);
  xhr_stop.send(null);

  xhr.open("POST", "http://" + hostname + port + "/play", true, "AirPlay", null);
  xhr.setRequestHeader("Content-Type", "text/parameters");
  xhr.send("Content-Location: " + url + "\nStart-Position: " + position + "\n");

  // set timer to prevent playback from aborting
  xhr.addEventListener("load", function() { 
    // aPause(hostname,port);

    clearInterval(timer);
    timer = setInterval(function() {

      var xhr = new XMLHttpRequest(),
        // 0 something wrong; 2 ready to play; >2 playing
        playback_info_keys_count = 0;
      
      xhr.open("GET", "http://" + hostname + port + "/playback-info", true, "AirPlay", null);

      xhr.addEventListener("load", function() {

        var i, rate, playback_rate,
            playback = {}, 
            playback_info_keys = xhr.responseXML.getElementsByTagName("dict")[0].childNodes;

        info_keys = playback_info_keys;
        url_loaded = true;

        console.log(xhr.responseXML);
        console.log(info_keys);

        for(i=0; i<playback_info_keys.length; i++){
          if(playback_info_keys[i].textContent == "loadedTimeRanges"){
            playback.duration_seconds = playback_info_keys[i+2].getElementsByTagName("real")[0].textContent;
            playback.duration_minutes = Number(playback.duration_seconds)/60;

            if(playback.duration_minutes > 1){
              timeout = 60000;
            } else {
              timeout = 20000;
            };
          }

          if(playback_info_keys[i].textContent == "duration"){
            playback.total_duration_seconds = playback_info_keys[i+2].textContent;
            playback.total_duration_minutes = Number(playback.total_duration_seconds)/60;
          }

          if(playback_info_keys[i].textContent == "position"){
            playback.position_seconds = playback_info_keys[i+2].textContent;
            playback.position_minutes = Number(playback.position_seconds)/60;
          }

          if(playback_info_keys[i].textContent == "rate"){
            rate = playback_info_keys[i+2].textContent;
          }

        }

        playback_rate = Number(rate);
        if(playback_rate > 0){
          // clearInterval(timer);
          chrome.browserAction.setBadgeText({text:'Play'});
        } else if(typeof playback.duration_minutes !== 'undefined') {
          chrome.browserAction.setBadgeText({text:playback.duration_minutes.toFixed(1)});
        } else {
          chrome.browserAction.setBadgeText({text:''});
        }
        console.log(playback.duration_minutes, playback.position_minutes, rate);

        if(playback_rate && playback.duration_minutes < 2){
          aPause(hostname, port);
        } else if (!playback_rate && !playback_started && playback.duration_minutes >= 5) {
          var xhr_play = new XMLHttpRequest();

          playback_started = true;

          xhr_play.open("POST", "http://" + hostname + port + "/rate?value=1", true, "AirPlay", null);
          xhr_play.addEventListener("load", function() {
          });

          xhr_play.send(null);
        }

        playback_info_keys_count = xhr.responseXML.getElementsByTagName("key").length;
        console.log("playback: " + playback_started + "; keys: " + playback_info_keys_count);

        // if we're getting some actual playback info
        if (!url_loaded && playback_info_keys_count > 2) {
          playback_started = true;
          console.log("setting playback_started = true")
          terminate_loop = false;
        }

        // playback terminated 
        // if (!terminate_loop && playback_info_keys_count <= 2) {
        //   console.log("stopping loop & setting playback_started = false");
        //   clearInterval(timer);
        //   var xhr_stop = new XMLHttpRequest();
        //   xhr_stop.open("POST", "http://" + hostname + port + "/stop", true, "AirPlay", null);
        //   // xhr_stop.send(null);         
        //   url_loaded = false;
        // }

        // playback stopped, AppleTV is "readyToPlay"
        // if (url_loaded && playback_info_keys_count == 2) {
        //   console.log("sending /stop signal, setting playback_started = false")
        //   var xhr_stop = new XMLHttpRequest();
        //   xhr_stop.open("POST", "http://" + hostname + port + "/stop", true, "AirPlay", null);
        //   // xhr_stop.send(null);
        //   url_loaded = false;
        //   terminate_loop = true;
        // }

        setNowPlayingData(globals.link, globals.metaInfo, playback);

      }, false);

      xhr.addEventListener("error", function() {
        clearInterval(timer);
      }, false);

      xhr.send(null);

    }, timeout);

  }, false);

};

chrome
  .runtime
    .onInstalled
      .addListener(function (details) {
        console.log('previousVersion', details.previousVersion);
      });

chrome
  .runtime
    .onMessage
      .addListener(function(request, sender, sendResponse) {
        globals.link = request.link;
        globals.metaInfo = request.metaInfo;
        aPlay(request.link,request.playback.position_seconds);
      });

chrome
  .runtime
    .onMessageExternal
      .addListener(function(request, sender, sendResponse) {
        globals.link = request.mpfour;
        globals.metaInfo = request.metaInfo;
        aCheck(request.mpfour);
      });