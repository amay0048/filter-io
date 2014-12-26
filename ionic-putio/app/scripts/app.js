'use strict';
// Ionic Starter App, v0.9.20

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('airplayPutioApp', ['ionic', 'config', 'downloader'])

.run(function($ionicPlatform, $rootScope) {
  // for browser testing
  $rootScope.token = '';
  $rootScope.loggedin = false;
  
  $ionicPlatform.ready(function() {

    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if(window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
    }
    if(window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
  });
})

.config(function($stateProvider, $urlRouterProvider) {
  $stateProvider

    .state('app', {
      url: '/app',
      abstract: true,
      templateUrl: 'views/menu.html',
      controller: 'MenuCtrl'
    })

    .state('app.splash', {
      url: '/splash',
      views: {
        'menuContent' :{
          templateUrl: 'views/splashscreen.html',
          controller: 'SplashscreenCtrl'
        }
      }
    })
    .state('app.listfiles', {
      url: '/listfiles/:fileId',
      views: {
        'menuContent' :{
          templateUrl: 'views/listfiles.html',
          controller: 'ListfilesCtrl'
        }
      }
    })
    .state('app.filedetail', {
      url: '/filedetail/:fileId',
      views: {
        'menuContent' :{
          templateUrl: 'views/filedetail.html',
          controller: 'FiledetailCtrl'
        }
      }
    });

    // .state('app.single', {
    //   url: '/playlists/:playlistId',
    //   views: {
    //     'menuContent' :{
    //       templateUrl: 'templates/playlist.html',
    //       controller: 'PlaylistCtrl'
    //     }
    //   }
    // });
  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/app/splash');
});

