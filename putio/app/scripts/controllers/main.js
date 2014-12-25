'use strict';

angular.module('putioAngularApp')
  .controller('MainCtrl', function ($scope, $routeParams, $http, notifier, Airplay, Videos) {

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

    $scope.videoLink = function(item,$event){

      $event.preventDefault();
      var checkInUrl, uri = item.uri;
      
      Airplay.playItem(item);

      if($scope.traktLogin && typeof item.trakt !== 'undefined'){

        var data = {
          'username': $scope.traktLogin.name,
          'password': $scope.traktLogin.password,
          'title': item.trakt.title,
        };

        if(typeof item.trakt.tvdb_id !== 'undefined'){
          checkInUrl = 'http://api.trakt.tv/show/checkin/';
          data.tvdb_id = item.trakt.tvdb_id;
        } else {
          checkInUrl = 'http://api.trakt.tv/movie/checkin/';
          data.imdb_id = item.trakt.imdb_id;
        }

        if(typeof item.season !== 'undefined'){
          data.season = item.season;
        }

        if(typeof item.episode !== 'undefined'){
          data.episode = item.episode;
        }

        $http.post(checkInUrl+$scope.scrobbleKey, data).success(function(response,responseCode,getName,request){
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
      // $scope.openUrl(uri,'_blank');
    };

    $scope.openUrl = function(location,target){
      // This is being set as it's potentially an external window, and 
      // we want the option to controll it through javascript
      $scope.screen = window.openUrl(location, target);
      return false;
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

    $scope.addFiles = function(data){
      var contentType, directories = [], videos = [];
      for(var i = 0; i < data.length; i++){
        contentType = data[i].content_type;
        if(/directory/ig.test(contentType)){
          directories.push(data[i]) ;
        } else if(/video/ig.test(contentType)){
          videos.push(data[i]);
        }
        $scope.videos = Videos.addMany(videos);
        Videos.processDirectories(directories);
      }
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
      if(macgap) {
        macgap.growl.notify({title: 'Trakt', content: text});
      } else {        
        var notification = {
            template: text,
            hasDelay: false,
            delay: 3000,
            type: 'info',
            position: 'top left'
        };
        notifier.notify(notification);
      }
    };

  });
