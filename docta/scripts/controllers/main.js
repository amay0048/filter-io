'use strict';

angular.module('doctaApp')
  .controller('MainCtrl', function ($scope,$filter,Patients,ngProgress) {

    ngProgress.reset();
  	ngProgress.start();
  	
    Patients.getPatients().then(function(promise){
    	ngProgress.complete();
    	$scope.patients = promise;
    	$scope.groupedPatients = $filter('modulus')(promise, 4);
    });
  });