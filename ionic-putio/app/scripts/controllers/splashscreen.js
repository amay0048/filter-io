'use strict';

/**
 * @ngdoc function
 * @name airplayPutioApp.controller:SplashscreenCtrl
 * @description
 * # SplashscreenCtrl
 * Controller of the airplayPutioApp
 */
angular.module('airplayPutioApp')
  .controller('SplashscreenCtrl', function ($scope, $state, $rootScope, Putio) {
  	var externalWindowReference;

    $scope.loginOnClick = function(){
    	var url = Putio.getLoginUrl(),
    		token = '',
    		separator = '#access_token=';

    	externalWindowReference = window.open(url, '_blank', 'toolbarposition=top,presentationstyle=pagesheet,location=yes');
    	externalWindowReference.addEventListener('loadstart',function(externalWindow){

    		if(externalWindow.url.indexOf(separator) > 0)
    		{
    			token = externalWindow.url.split(separator)[1];
    			externalWindowReference.close();
    			$rootScope.token = token;
    			$rootScope.loggedin = true;
    			$state.go('app.listfiles');
    		}
    	});
    };
  });
