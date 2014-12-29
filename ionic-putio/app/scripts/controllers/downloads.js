'use strict';

/**
 * @ngdoc function
 * @name airplayPutioApp.controller:DownloadsCtrl
 * @description
 * # DownloadsCtrl
 * Controller of the airplayPutioApp
 */
angular.module('airplayPutioApp')
  .controller('DownloadsCtrl', function ($scope, DownloadManager) {
  	
    $scope.activeDownloads = DownloadManager.active;
    $scope.threadPercent = function(thread){
        return Math.floor(thread.status.percent * 100) + '%';
    };

    $scope.pendingDownloads = DownloadManager.pending;

  });
