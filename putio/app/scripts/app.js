'use strict';

angular
  .module('putioAngularApp', [
    'ngCookies',
    'ngResource',
    'ngSanitize',
    'ngRoute'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/series', {
        templateUrl: 'views/series.html',
        controller: 'MainCtrl'
      })
      .when('/videos', {
        templateUrl: 'views/videos.html',
        controller: 'MainCtrl'
      })
      .when('/videos/:serial/:season', {
        templateUrl: 'views/videos.html',
        controller: 'MainCtrl'
      })
      .when('/movies', {
        templateUrl: 'views/movies.html',
        controller: 'MainCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
