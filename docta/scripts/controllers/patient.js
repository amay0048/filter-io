'use strict';

angular.module('doctaApp')
  .controller('PatientCtrl', function ($scope,$routeParams,Patients,ngProgress) {
    //window.PatientCtrl = $scope;

  	var _params = $scope.params = $routeParams;
    	
    $scope.PatientFormModel = {};

  	if(typeof _params._id !== 'undefined'){
      ngProgress.reset();
      ngProgress.start();
      
  		Patients.getPatientById(_params._id).then(function(result){
        $scope.PatientFormModel = result.attributes;
        ngProgress.complete();
      });
  	}

  	$scope.PatientFormSubmit = function() {
      if(typeof _params._id === 'undefined'){
  		  Patients.createPatient($scope.PatientFormModel);
      } else {
        $scope.PatientFormModel.id = _params._id;
        Patients.updatePatient($scope.PatientFormModel);
      }
    };

  });