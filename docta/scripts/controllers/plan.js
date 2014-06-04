'use strict';

angular.module('doctaApp')
  .controller('PlanCtrl', function ($scope,$routeParams,Plans,ngProgress) {
    window.PlanCtrl = $scope;

		var _params = $scope.params = $routeParams;

  	$scope.Plan = {};
    $scope.Appointment = {};

  	$scope.AppointmentFormModel = {};
    $scope.appointmentFormVisible = false;

  	$scope.AppointmentFormSubmit = function(){
      $scope.AppointmentFormModel.Number = Number($scope.AppointmentFormModel.Number);
      if(typeof $scope.Appointment.id !== 'undefined'){
        $scope.updateAppointment();
      } else {
        $scope.createAppointment();
      }
    };

    $scope.PlanFormSubmit = function(){
        $scope.updatePlan();
    };

    $scope.createAppointment = function(){
      var appointment = Plans.createAppointment($scope.AppointmentFormModel);
      appointment.then(function(promise){
        $scope.Plan.relation('appointments').add(promise);
        $scope.Plan.appointments.create(promise);
        $scope.updatePlan();
      });
    };

    $scope.updateAppointment = function(){
      var appointment = Plans.updateAppointment($scope.AppointmentFormModel);
      appointment.then(function(promise){
        $scope.Plan.appointments.create(promise);
        $scope.updatePlan();
      });
    };

  	$scope.createPlan = function(){
      var plan = Plans.createPlan($scope.Plan);
      plan.then(function(promise){
        $scope.Plan = promise;
      });
  	};
  	
  	$scope.updatePlan = function(){
      var plan = Plans.updatePlan($scope.Plan);
      plan.then(function(promise){
        $scope.Plan = promise;
      });
  	};
  		
    $scope.showAppointmentForm = function(appointment){
      $scope.Appointment = appointment;
      $scope.AppointmentFormModel = appointment.attributes;
      $scope.appointmentFormVisible = true;
    };

    $scope.hideAppointmentForm = function(){
      $scope.appointmentFormVisible = false;
    };

    ngProgress.reset();
    ngProgress.start();

    if(typeof _params._id !== 'undefined'){
      Plans.getPlanById(_params._id).then(function(promise){
        $scope.Plan = promise;
        Plans.getAppointments(promise).then(function(promise){
          $scope.Plan.appointments.add(promise);
          ngProgress.complete();
        });
      });
    } else {
      $scope.createPlan();
    }

  });
