'use strict';

angular
  .module('putioAngularApp', [
    'ngCookies',
    'ngResource',
    'ngSanitize',
    'ngRoute',
    //amay0048
    'ngAnimate',
    'llNotifier'
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
      .when('/trakt', {
        templateUrl: 'views/trakt.html',
        controller: 'MainCtrl'
      })
      .when('/:token', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
