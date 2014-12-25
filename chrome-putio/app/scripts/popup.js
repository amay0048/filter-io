'use strict';

window.item = {};

chrome.storage.local.get([
  'nowPlaying'
], function(item) {
  if(typeof item.nowPlaying !== 'undefined'){
    window.item = item;
    document.getElementById('nowplaying-title').innerText = item.nowPlaying.metaInfo.title;
    document.getElementById('nowplaying-position').innerText = item.nowPlaying.playback.position_minutes;
  }
});

var airplayButtonOnClick = function(){
  // local
  console.log(window.item.nowPlaying);
  if(typeof item.nowPlaying !== 'undefined'){
    var percent = item.nowPlaying.playback.position_minutes/item.nowPlaying.playback.total_duration_minutes;
    item.nowPlaying.playback.position_seconds = percent.toString();
    chrome.runtime.sendMessage(null, item.nowPlaying);
  }
}

document
  .getElementById('airplayButton')
    .addEventListener('click', airplayButtonOnClick);