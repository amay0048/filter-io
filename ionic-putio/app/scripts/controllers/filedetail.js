'use strict';

/**
 * @ngdoc function
 * @name airplayPutioApp.controller:FiledetailCtrl
 * @description
 * # FiledetailCtrl
 * Controller of the airplayPutioApp
 */
angular.module('airplayPutioApp')
  .controller('FiledetailCtrl', function ($scope, $http, $rootScope, $stateParams, Putio, Trakt, VideoPlayer, DownloadManager) {

    $scope.fileId = 0;
    
    if(typeof $stateParams.fileId !== 'undefined')
    {
      $scope.fileId = $stateParams.fileId;
    }
    
    $scope.file = {
      name:'Loading...'
    };

    Putio.getFileDetail($scope.fileId).then(function(file){
      $scope.file = file;
      if(Object.keys($scope.file).length > 1)
      {
        $scope.file = Trakt.addMeta($scope.file);
        aCheck();
      }
    },function(err){
      console.log(err);
    },function(file){
      $scope.file = file;
      if(Object.keys($scope.file).length > 1)
      {
        $scope.file = Trakt.addMeta($scope.file);
        aCheck();
      }
    });

    $scope.downloadOnClick = function(){
      var url = 'https://put.io/v2/files/'+$scope.file.id;
      
          if($scope.file.is_mp4_available)
          {
            url += '/mp4'
          }
          url += '/stream?token='+$rootScope.token;

      DownloadManager.addDownload(url,$scope.file);
    };

    var aCheck = function(){

      var url = 'https://put.io/v2/files/'+$scope.file.id;
      if($scope.file.is_mp4_available)
      {
        url += '/mp4'
      }
      url += '/stream?token='+$rootScope.token;

      var xhr = new XMLHttpRequest();
      xhr.open('HEAD', url, true);
      xhr.addEventListener('load', function(progress) {
        var link = progress.target.responseURL;
        VideoPlayer.play(link);
      });

      xhr.send(null);
    };

  });
