'use strict';

angular
  .module('doctaApp', [
    'ngCookies',
    'ngResource',
    'ngSanitize',
    'ngRoute',
    'parse-angular',
    'parse-angular.enhance',
    'ngProgress'
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/plan', {
        templateUrl: 'views/plan.html',
        controller: 'PlanCtrl'
      })
      .when('/plan/:_id', {
        templateUrl: 'views/plan.html',
        controller: 'PlanCtrl'
      })
      .when('/plans', {
        templateUrl: 'views/plans.html',
        controller: 'PlansCtrl'
      })
      .when('/patients', {
        templateUrl: 'views/patients.html',
        controller: 'PatientsCtrl'
      })
      .when('/patient', {
        templateUrl: 'views/patient.html',
        controller: 'PatientCtrl'
      })
      .when('/patient/:_id', {
        templateUrl: 'views/patient.html',
        controller: 'PatientCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });

(function(){
  var applicationId = 'QrleD4a61is4v8u1Iz91xLUzGLvGGePw1z1sd0FZ';
  var javaScriptKey = 't4xWQ8o0oztR9TaPoF0kGatu5ndhZbLzz5tjgaFD';
  window.Parse.initialize(applicationId, javaScriptKey);
})();