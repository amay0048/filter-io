'use strict';

// Saves options to chrome.storage
function save_options() {
  // Create a simple text notification:
  var notification = chrome.notifications.create(
    'hello',
    {
      type: 'basic',
      title: 'Hello!',  // notification title
      message: 'Lorem ipsum...',  // notification body text
      iconUrl: 'images/icon-128.png'
    },
    function(){
      console.log(arguments);
    }
  );

  var color = document.getElementById('color').value;
  var likesColor = document.getElementById('like').checked;

  // local
  chrome.storage.sync.set({
    favoriteColor: color,
    likesColor: likesColor
  }, function() {
    // Update status to let user know options were saved.
    var status = document.getElementById('status');
    status.textContent = 'Options saved.';
    setTimeout(function() {
      status.textContent = '';
    }, 750);
  });
}

// Restores select box and checkbox state using the preferences
// stored in chrome.storage.
function restore_options() {
  // Use default value color = 'red' and likesColor = true.
  chrome.storage.sync.get([
    'favoriteColor',
    'likesColor'
  ], function(items) {
    document.getElementById('color').value = items.favoriteColor;
    document.getElementById('like').checked = items.likesColor;
  });
}

document
  .addEventListener('DOMContentLoaded', restore_options);
document
  .getElementById('save')
    .addEventListener('click',
    save_options);