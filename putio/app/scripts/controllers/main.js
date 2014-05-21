'use strict';

angular.module('putioAngularApp')
  .controller('MainCtrl', function ($scope,$routeParams,Videos,$http,notifier) {

    window.AngularApp = $scope;

    $scope.params = $routeParams;

    if(typeof $scope.params.token !== 'undefined'){
      Videos.setCode($scope.params.token);
    }

    $scope.code = Videos.getCode();
    $scope.videos = Videos.getVideos();
    $scope.serials = Videos.getSerials();
    $scope.movies = Videos.getMovies();
    $scope.screen = {};
    $scope.scrobbleKey = Videos.getScrobbleKey();
    $scope.traktLogin = Videos.getTraktLogin();

    $scope.videoLink = function(item){
      var uri = item.uri;
      $scope.screen = window.open(uri, '_blank');
      if($scope.traktLogin){
        var data = {
          'username': $scope.traktLogin.name,
          'password': $scope.traktLogin.password,
          'tvdb_id': item.trakt.tvdb_id,
          'title': item.name,
          'season': item.season,
          'episode': item.episode,
        };
        $http.post('http://api.trakt.tv/show/checkin/'+$scope.scrobbleKey, data).success(function(response,responseCode,getName,request){
          if(response.status === 'success'){
            $scope.notification(response.message);
          } else {
            console.log(response);
            $scope.notification(response.error);
          }
        });
      } else {
        $scope.notification('Please login to trakt to allow scrobbling');
      }
    };

    $scope.updateTrakt = function(data){
      var formData = $(data.target).serializeArray(), traktLogin = {};
      console.log(formData);
      for(var i = 0;i<formData.length;i++){
        traktLogin[formData[i].name] = formData[i].value;
      }
      $scope.traktLogin = Videos.updateTraktLogin(traktLogin);
    };

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

    $scope.notification = function(text) {
        var notification = {
            template: text,
            hasDelay: false,
            delay: 3000,
            type: 'info',
            position: 'top left'
        };
        notifier.notify(notification);
    };
    /*
    var $mainDiv = $('.section.main');
    $scope.setBackground = function (obj) {
      var keys = Object.keys(obj);
      var rand = Math.floor(keys.length * Math.random());
      if(obj[keys[rand]].trakt){
        $mainDiv.css('background-image','url('+obj[keys[rand]].trakt.images.fanart+')');
      }
      return null;
    };

    $scope.setBackgroundFilter = function (obj) {
      console.log(obj);
      if(obj.trakt){
        $mainDiv.css('background-image','url('+obj.trakt.images.fanart+')');
      }
      return null;
    };
    */

  });
