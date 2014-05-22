'use strict';

angular.module('putioAngularApp')
  .factory('Videos', function () {
    // This is where I can query localstorage using lawnchair

    var _videos = this._videos= [];
    var _serials = this._serials = {};
    var _movies = this._movies = {};
    var _slugMap = this._slugMap = {};
    var _code = this._code = null;
    var _traktLogin = this._traktLogin = {};
    var _scrobbleKey = this._scrobbleKey = '518b4f4ed52cf8acbe32e8d578fc5b49a289373b';
    var _cookieExpires = this._cookieExpires = 20*365;

    if(typeof $ !== 'undefined' && typeof $.cookie('code') !== 'undefined'){
      _code = $.cookie('code');
      $.cookie('code', _code, { expires: _cookieExpires });
    }

    if(typeof $ !== 'undefined' && typeof $.cookie('traktUsername') !== 'undefined' && typeof $.cookie('traktSHA1') !== 'undefined'){
      _traktLogin.name = $.cookie('traktUsername');
      _traktLogin.password = $.cookie('traktSHA1');
      $.cookie('traktUsername', _traktLogin.name, { expires: _cookieExpires });
      $.cookie('traktSHA1', _traktLogin.password, { expires: _cookieExpires });
    }

    if(typeof Lawnchair !== 'undefined'){
      Lawnchair(function(){
        this.get('videos', function(obj) {
          if(typeof obj !== 'undefined'){
            _videos = obj.value;
          }
        });
        this.get('serials', function(obj) {
          if(typeof obj !== 'undefined'){
            _serials = obj.value;
          }
        });
        this.get('movies', function(obj) {
          if(typeof obj !== 'undefined'){
            _movies = obj.value;
          }
        });
        this.get('slugMap', function(obj) {
          if(typeof obj !== 'undefined'){
            _slugMap = obj.value;
          }
        });
      });
    }

    var startLoad = function(){
      if(NProgress){
        NProgress.inc();
      }
    };

    var getFiles = function(code){
      var jssrc = 'https://api.put.io/v2/files/search/from:me%20type:video/page/-1?oauth_token='+code+'&callback=putioCB';
      var cbScriptTarget = document.getElementsByTagName('head')[0];
      var cbScript = document.createElement('script');
      cbScript.src = jssrc;
      cbScriptTarget.appendChild(cbScript);
      startLoad();
    }

    if(_code){
      getFiles(_code);
    }

    // Serial/Series related functions

    var updateCache = function(){
      if(typeof Lawnchair !== 'undefined'){
        Lawnchair(function(){
          this.save({key:'videos', value:_videos});
          this.save({key:'serials', value:_serials});
          this.save({key:'movies', value:_movies});
          this.save({key:'slugMap', value:_slugMap});
        });
      }
    };

    var addEpisodeMeta = function(item,match){
      match = match.toString().replace(/[,]+/g,',').split(',');
      item.name = match[1].replace(/\W+/ig,' ').trim();
      item.key = sanatise(match[1]);
      item.season = Number(match[2].trim());
      item.episode = Number(match[3].trim());

      return item;
    };

    var serialLookup = function(item){
      var name = item.name;
      var key = item.key;
      var season = item.season;

      if(typeof _serials[key] === 'undefined'){
        _serials[key] = {
          name:name,
          key:key,
          seasons:[],
          season:{}
        };
        var cbScriptTarget = document.getElementsByTagName('head')[0];
        var cbScript = document.createElement('script');
        cbScript.src = 'http://api.trakt.tv/search/shows.json/f4980e1fa96b6e330e1ca87430a33160?query='+name+'&limit=1&callback=traktCB';
        cbScriptTarget.appendChild(cbScript);
        startLoad();
      }
      if(_serials[key].seasons.indexOf(season) < 0){
        _serials[key].seasons.push(season);
      }
    };

    var episodesLookup = function(serial,key){
      var cbScriptTarget = document.getElementsByTagName('head')[0];
      var slug = serial.trakt.url.split('/').pop();
      _slugMap[key] = slug;
      _slugMap[slug] = key;
      angular.forEach(serial.seasons,function(season){
        var cbScript = document.createElement('script');
        cbScript.src = 'http://api.trakt.tv/show/season.json/f4980e1fa96b6e330e1ca87430a33160/'+slug+'/'+season+'?callback=traktCB2';
        cbScriptTarget.appendChild(cbScript);
        startLoad();
      });
    };

    // Movie related functions
    var addMovieMeta = function(item,match){
      match = match.toString().replace(/[,]+/g,',').split(',');
      item.name = match[1].replace(/\W+/ig,' ').trim();
      item.key = sanatise(match[1]);

      return item;
    };

    var movieLookup = function(item){
      var name = item.name;
      var key = item.key;

      if(typeof _movies[key] === 'undefined'){
        _movies[key] = {
          name:item.putio.name,
          putio:item.putio
        };
        var cbScriptTarget = document.getElementsByTagName('head')[0];
        var cbScript = document.createElement('script');
        cbScript.src = 'http://api.trakt.tv/search/movies.json/f4980e1fa96b6e330e1ca87430a33160?query='+name+'&limit=1&callback=traktCB3';
        cbScriptTarget.appendChild(cbScript);
        startLoad();
      }
    };

    // This is a function to allow mapping of the data returned
    // from the Trakt api with the keys that I'm putting in.
    // I'm calling using JSONP callbacks and embedded scripts
    // otherwise I run into massive issues with CORS. 

    var sanatise = function(string){
      return string.replace(/\W+/ig,' ').trim().replace(/\bus$|\buk$|\b\d\d\d\d$/ig,' ').trim().toLowerCase();
    };

    // Public API here
    return {
      getCode: function() {
        return _code;
      },
      setCode: function(token){
        var code = token.split('=').pop();
        if(code){
          getFiles(code);
        }
        if(typeof $ !== 'undefined'){
          $.cookie('code', code, { expires: _cookieExpires });
        }
        _code = code;
      },
      getTraktLogin: function(){
        return _traktLogin;
      },
      updateTraktLogin: function(data){
        console.log(data);
        data.password = CryptoJS.SHA1(data.password.toString()).toString();
        _traktLogin = data;
        if(typeof $ !== undefined){
          $.cookie('traktUsername', _traktLogin.name, { expires: _cookieExpires });
          $.cookie('traktSHA1', _traktLogin.password, { expires: _cookieExpires });
        }
        return _traktLogin;
      },
      getScrobbleKey: function(){
        return _scrobbleKey;
      },
      // Video related functions
      getVideos: function () {
        return _videos;
      },
      addVideo: function(file) {
        var maskEpisode = /(.+?)[Ss](\d+)[Ee](\d+)|(.+?)(\d{1,2})x(\d{1,2})|(.+?)season.*?(\d{1,2}).*?episode.*?(\d{1,2})/i;
        var matchEpisode = file.name.match(maskEpisode);

        var maskMovie = /(.+?)(\d\d\d\d)/i;
        var matchMovie = file.name.match(maskMovie);

        var item = {
          name: file.name,
          putio: file,
          new: true
        };

        if(!file.is_mp4_available){
          item.uri = 'https://put.io/v2/files/'+file.id+'/stream?'+'token='+_code;
        } else {
          item.uri = 'https://put.io/v2/files/'+file.id+'/mp4/stream?'+'token='+_code;
        }

        if(matchEpisode){
          item = addEpisodeMeta(item,matchEpisode);
          serialLookup(item);
        } else if(matchMovie){
          item = addMovieMeta(item,matchMovie);
          movieLookup(item);
        }

        angular.forEach(_videos,function(obj){
          if(obj.putio.id == item.putio.id){
            delete item.new;
          }
        });
        if(item.new){
          _videos.push(item);
          updateCache();
        }
        return _videos;
      },
      addMany: function(files){
        var _self = this;
        angular.forEach(files,function(file){
          _self.addVideo(file);
        });
        return _videos;
      },
      // Serial related functions
      getSerials: function () {
        return _serials;
      },
      addSerial: function(item) {
        var _self = this;
        var key = sanatise(item.title);
        if(typeof _serials[key] !== 'undefined'){
          _serials[key].trakt = item;
          _serials[key].name = item.title;
          episodesLookup(_serials[key],key);
        }
        _self.linkSerials();
        updateCache();
        return _serials;
      },
      linkSerials: function(){
        var _self = this;
        angular.forEach(_videos,function(video){
          var key = video.key;
          if(typeof _serials[key] !== 'undefined' && typeof video.trakt === 'undefined'){
            video.trakt = _serials[key].trakt;
          }
        });
        _self.linkEpisodes();
      },
      addEpisodes: function(data) {
        var _self = this;
        var explodeUrl = data[0].url.split('/').reverse();
        var key = _slugMap[explodeUrl[4]];
        var season = explodeUrl[2];
        _serials[key].season[season] = data;
        _self.linkEpisodes(key,season);
        return _serials;
      },
      linkEpisodes: function(key,season){
        angular.forEach(_videos, function (video) {
          // The following statement throws an error, not sure why
          if(video.key == key && video.season == season && typeof _serials[key] !== 'undefined'){
              video.meta = _serials[key].season[season][video.episode-1];
          }
        });
        updateCache();
      },
      getMovies: function(){
        return _movies;
      },
      addMovie: function(data) {
        var key = sanatise(data.title);
        if(typeof _movies[key] !== 'undefined'){
          _movies[key].trakt = data;
        }
        updateCache();
        return _movies;
      }
    };
  });
