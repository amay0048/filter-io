'use strict';

angular.module('doctaApp')
  .controller('PatientsCtrl', function ($scope,$filter,Patients,ngProgress) {
  	//window.PatientsCtrl = $scope;

    ngProgress.reset();
  	ngProgress.start();
  	
    Patients.getPatients().then(function(promise){
      $scope.patients = promise;
      $scope.groupedPatients = $filter('modulus')(promise, 4);
    	ngProgress.complete();
    });
  });
