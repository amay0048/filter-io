'use strict';

/**
 * @ngdoc function
 * @name airplayPutioApp.controller:FiledetailCtrl
 * @description
 * # FiledetailCtrl
 * Controller of the airplayPutioApp
 */
angular.module('airplayPutioApp')
  .controller('FiledetailCtrl', function ($scope, $http, $rootScope, $stateParams, Putio, Trakt, VideoPlayer) {

    $scope.fileId = 0;
    
    if(typeof $stateParams.fileId !== 'undefined')
    {
      $scope.fileId = $stateParams.fileId;
    }

    var streamUrl = 'https://put.io/v2/files/'+$scope.fileId+'/mp4/stream?token='+$rootScope.token;
    var url = 'https://api.put.io/v2/files/'+$scope.fileId+'?oauth_token='+$rootScope.token;
    
    $scope.file = {
      name:'Loading...'
    };

    Putio.getFileDetail($scope.fileId).then(function(file){
      $scope.file = file;
      if(Object.keys($scope.file).length > 1)
      {
        $scope.file = Trakt.addMeta($scope.file);
      }
    },function(err){
      console.log(err);
    },function(file){
      $scope.file = file;
      if(Object.keys($scope.file).length > 1)
      {
        $scope.file = Trakt.addMeta($scope.file);
      }
    });

    var aCheck = function(link){
      var xhr = new XMLHttpRequest();

      xhr.open('HEAD', link, true);
      xhr.addEventListener('load', function(progress) {
        var link = progress.target.responseURL;
        VideoPlayer.play(link);
      });

      xhr.send(null);
    };
    aCheck(streamUrl);

  });
