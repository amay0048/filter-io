'use strict';

/**
 * @ngdoc service
 * @name initApp.airplay
 * @description
 * # airplay
 * Service in the initApp.
 */
angular.module('putioAngularApp')
  .service('Airplay', function Airplay($http) {

  	window.playback_paused = false;

  	var aPause = function(hostname, port){
		if(typeof macgap !== 'undefined'){
			macgap.growl.notify({title: 'Airplay', content: 'PAUSED: buffering'});
		}

		var xhr_pause = new XMLHttpRequest();

		xhr_pause.open("POST", "http://" + hostname + port + "/rate?value=0.000000", true, "AirPlay", null);
		xhr_pause.addEventListener("load", function() {
		});

		xhr_pause.send(null);
  	};

    var aPlay = function(url){
		if(typeof macgap !== 'undefined'){
			macgap.growl.notify({title: 'Airplay', content: url});
		}

		var xhr = new XMLHttpRequest(),
			xhr_stop = new XMLHttpRequest(),
			hostname = "apple-tv.local",
			port =":7000",
			position = "0",
			timeout = 20000,
			timer;

		// xhr_stop.open("POST", "http://" + hostname + port + "/stop", true, "AirPlay", null);
		// xhr_stop.send(null);

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
					playback_info_keys_count = 0,
					terminate_loop, playback_started;
				
				xhr.open("GET", "http://" + hostname + port + "/playback-info", true, "AirPlay", null);

				xhr.addEventListener("load", function() {

					var i, total_minutes, rate,
						duration_seconds, duration_minutes, 
						position_seconds, position_minutes,
						playback_info_keys = xhr.responseXML.getElementsByTagName("dict")[0].childNodes;

					window.info_keys = playback_info_keys;

					for(i=0; i<playback_info_keys.length; i++){
						if(playback_info_keys[i].textContent == "loadedTimeRanges"){
							duration_seconds = playback_info_keys[i+2].getElementsByTagName("real")[0].textContent;
							duration_minutes = Number(duration_seconds)/60;

							if(duration_minutes > 1){
								timeout = 60000;
							} else {
								timeout = 20000;
							};
						}

						if(playback_info_keys[i].textContent == "position"){
							position_seconds = playback_info_keys[i+2].textContent;
							position_minutes = Number(position_seconds)/60;
						}

						if(playback_info_keys[i].textContent == "rate"){
							rate = playback_info_keys[i+2].textContent;
						}
					}

					window.playback_rate = Number(rate);
					console.log(duration_minutes, position_minutes, rate);

					if(window.playback_rate && duration_minutes < 3){
						aPause(hostname, port);
					} else if (!window.playback_rate && duration_minutes >= 5) {
						var xhr_play = new XMLHttpRequest();

						xhr_play.open("POST", "http://" + hostname + port + "/rate?value=1", true, "AirPlay", null);
						xhr_play.addEventListener("load", function() {
							window.playback_paused = false;
							playback_started = true;
						});

						xhr_play.send(null);
					}

					playback_info_keys_count = xhr.responseXML.getElementsByTagName("key").length;
					console.log("playback: " + playback_started + "; keys: " + playback_info_keys_count)

					// if we're getting some actual playback info
					if (!playback_started && playback_info_keys_count > 2) {
						playback_started = true;
						console.log("setting playback_started = true")
						terminate_loop = false;
					}

					// playback terminated 
					if (terminate_loop && playback_info_keys_count <= 2) {
						console.log("stopping loop & setting playback_started = false")
						clearInterval(timer);
						var xhr_stop = new XMLHttpRequest();
						xhr_stop.open("POST", "http://" + hostname + port + "/stop", true, "AirPlay", null);
						// xhr_stop.send(null);					
						playback_started = false;
					}

					// playback stopped, AppleTV is "readyToPlay"
					if (playback_started && playback_info_keys_count == 2) {
						console.log("sending /stop signal, setting playback_started = false")
						var xhr_stop = new XMLHttpRequest();
						xhr_stop.open("POST", "http://" + hostname + port + "/stop", true, "AirPlay", null);
						// xhr_stop.send(null);
						playback_started = false;
						terminate_loop = true;
					}

				}, false);

				xhr.addEventListener("error", function() {
					clearInterval(timer);
				}, false);

				xhr.send(null);

			}, timeout);

		}, false);

    };

    this.playItem = function(item){
    	aPlay(item.hls);
    };

    return this;
  });
