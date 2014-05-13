'use strict';

angular.module('putioAngularApp')
  .controller('MainCtrl', function ($scope,Videos) {

    window.AngularApp = $scope;

    $scope.videos = Videos.getVideos();
    $scope.serials = Videos.getSerials();

  	$scope.addVideo = function(data){
  		$scope.videos = Videos.addVideo(data);
  	};

    $scope.addVideos = function(data){
      $scope.videos = Videos.addMany(data);
    };

  	$scope.addSerial = function(data){
      $scope.serials = Videos.addSerial(data);
  	};

    $scope.addEpisodes = function(data){
      $scope.serials = Videos.addEpisodes(data);
    };

  });
