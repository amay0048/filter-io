'use strict';

angular.module('putioAngularApp')
  .controller('MainCtrl', function ($scope,$routeParams,Videos) {

    window.AngularApp = $scope;

    $scope.filter = $routeParams;

    $scope.videos = Videos.getVideos();
    $scope.serials = Videos.getSerials();
    $scope.movies = Videos.getMovies();

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

    $scope.addMovie = function(data){
      $scope.movies = Videos.addMovie(data);
    };

    $scope.isEmpty = function (obj) {
      return angular.equals({},obj); 
    };

    $scope.isFull = function (obj) {
      return !isNaN(obj); 
    };

  });
