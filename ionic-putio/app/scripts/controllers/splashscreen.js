'use strict';

/**
 * @ngdoc function
 * @name airplayPutioApp.controller:SplashscreenCtrl
 * @description
 * # SplashscreenCtrl
 * Controller of the airplayPutioApp
 */
angular.module('airplayPutioApp')
  .controller('SplashscreenCtrl', function ($scope, $state, $rootScope, Putio, DownloadManager) {
  	
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

    $scope.activeDownloads = DownloadManager.active;
    $scope.downloadTest = function(){
        // DownloadManager.addDownload('https://put.io/v2/files/260240625/mp4/stream?token=7bf1d7f99a6207b7772a69ec6d3b8cbfc2a41cff');
        DownloadManager.addDownload('https://put.io/v2/files/260759729/mp4/download?token=7bf1d7f99a6207b7772a69ec6d3b8cbfc2a41cff');
    };
    $scope.threadPercent = function(thread){
        return Math.floor(thread.status.percent * 100) + '%';
    };

  });
