'use strict';

/**
 * @ngdoc service
 * @name airplayPutioApp.trakt
 * @description
 * # trakt
 * Service in the airplayPutioApp.
 */
angular.module('airplayPutioApp')
  .service('Trakt', function Trakt($q, $http, LocalStorage) {
    // AngularJS will instantiate a singleton by calling "new" on this function
    var maskEpisode = /(.+?)[Ss](\d+)[Ee](\d+)|(.+?)(\d{1,2})x(\d{1,2})|(.+?)season.*?(\d{1,2}).*?episode.*?(\d{1,2})/i;
    var maskMovie = /(.+?)(\d\d\d\d)/i;
    var apiKey = 'f4980e1fa96b6e330e1ca87430a33160';
    var protocol = 'http:';

    var getTrakt = function(item){
      var url, type,
          slug = sanatise(item.cleanName).replace(/\s+/ig,'-');

      if(typeof item.trakt.movie !== 'undefined')
      {
        type = 'movie';
        url = item.traktMovieUrl();
      }
      else if(typeof item.trakt.episode !== 'undefined')
      {
        slug += '-s'+item.season;
        type = 'episode';
        url = item.traktEpisodesUrl();
      } 
      else
      {
        type = 'season';
        url = item.traktSeasonUrl();
      }

      (function(item, type, slug){

        if(type == 'episode')
        {
          var cache = LocalStorage.getObject(type+':'+slug);
          try
          {
            item.trakt[type] = cache[Number(item.episode)-1];
          }
          catch(e){}
        }
        else
        {
          item.trakt[type] = LocalStorage.getObject(type+':'+slug);
        }

        if(type == 'season' && Object.keys(item.trakt.season).length)
        {
          item.trakt.episode = {};
          getTrakt(item);
        }

        $http.get(url).
          success(function(data, status, headers, config) {
            // this callback will be called asynchronously
            // when the response is available
            var metaData = data[0];            
            if(type == 'episode')
            {
              metaData = data;
            }

            LocalStorage.setObject(type+':'+slug, metaData);

            if(type == 'episode')
            {
              var cache = LocalStorage.getObject(type+':'+slug);
              try
              {
                item.trakt[type] = cache[Number(item.episode)-1];
              }
              catch(e){}
            }
            else
            {
              item.trakt[type] = LocalStorage.getObject(type+':'+slug);
            }

            if(type == 'season')
            {
              item.trakt.episode = {};
              getTrakt(item);
            }

          }).
          error(function(data, status, headers, config) {
            // called asynchronously if an error occurs
            // or server returns response with an error status.
          });
      }(item, type, slug));
    };

    var addMovieMeta = function(item, match){
      match = match.toString().replace(/[,]+/g,',').split(',');
      item.cleanName = match[1].replace(/\W+/ig,' ').trim();
      item.key = sanatise(match[1]);

      item.traktMovieUrl = function(){
        var name = this.cleanName;

      	return protocol+'//api.trakt.tv/search/movies.json/'+apiKey+'?query='+name+'&limit=1';
      }

      getTrakt(item);
      return item;
    };

    var addEpisodeMeta = function(item, match){
      match = match.toString().replace(/[,]+/g,',').split(',');
      item.cleanName = match[1].replace(/\W+/ig,' ').trim();
      item.key = sanatise(match[1]);
      item.season = Number(match[2].trim());
      item.episode = Number(match[3].trim());

      item.traktSeasonUrl = function(){
        var name = this.cleanName;

        return protocol+'//api.trakt.tv/search/shows.json/'+apiKey+'?query='+name+'&limit=1';
      };

      item.traktEpisodesUrl = function(){
        var slug = this.trakt.season.url.split('/').pop(),
            season = this.season;

        return protocol+'//api.trakt.tv/show/season.json/'+apiKey+'/'+slug+'/'+season;
      };

      getTrakt(item);
      return item;
    };

    var sanatise = function(string){
      return string.replace(/\W+/ig,' ').trim().replace(/\bus$|\buk$|\b\d\d\d\d$/ig,' ').trim().toLowerCase();
    };

    this.addMeta = function(item){
      var fileName = item.name;
      var matchEpisode = fileName.match(maskEpisode);
      var matchMovie = fileName.match(maskMovie);

      if(matchEpisode)
      {
        item.trakt = {
          season: {}
        };
        return addEpisodeMeta(item,matchEpisode);
      }
      else if(matchMovie)
      {
        item.trakt = {
          movie: {}
        };
        return addMovieMeta(item,matchMovie);
      }
    };

    return this;
  });
