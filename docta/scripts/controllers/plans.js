'use strict';

angular.module('doctaApp')
	.controller('PlansCtrl', function ($scope,$filter,Plans,ngProgress) {
		//window.PlansCtrl = $scope;

    ngProgress.reset();
  	ngProgress.start();

		Plans.getPlans().then(function(promise){
			$scope.plans = promise;
			$scope.groupedPlans = $filter('modulus')(promise, 4);
			ngProgress.complete();
		});
	});
