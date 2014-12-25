'use strict';

/**
 * @ngdoc service
 * @name airplayPutioApp.putio
 * @description
 * # putio
 * Service in the airplayPutioApp.
 */
angular.module('airplayPutioApp')
  .service('Putio', function Putio($q, $http, $timeout, $rootScope, LocalStorage) {

    // AngularJS will instantiate a singleton by calling "new" on this function
    this.listFiles = function(fileId){
    	var deferred = $q.defer(),
          url = 'https://api.put.io/v2/files/list/'+fileId+'?oauth_token='+$rootScope.token,
          prefix = 'fileId:list:';

      $timeout(function(){
        deferred.notify(LocalStorage.getObject(prefix+fileId));
      },0);

      $http.get(url).
        success(function(data, status, headers, config) {
          LocalStorage.setObject(prefix+fileId,data.files);
          deferred.resolve(LocalStorage.getObject(prefix+fileId));
        }).
        error(function(data, status, headers, config) {
          deferred.reject(data);
        });

    	return deferred.promise;
    };

    this.getFileDetail = function(fileId){
      var deferred = $q.defer(),
          url = 'https://api.put.io/v2/files/'+fileId+'?oauth_token='+$rootScope.token,
          prefix = 'fileId:detail:';

      $timeout(function(){
        deferred.notify(LocalStorage.getObject(prefix+fileId));
      },0);

      $http.get(url).
        success(function(data, status, headers, config) {
          LocalStorage.setObject(prefix+fileId,data.file);
          deferred.resolve(LocalStorage.getObject(prefix+fileId));
        }).
        error(function(data, status, headers, config) {
          deferred.reject(data);
        });

      return deferred.promise;
    };

    this.getLoginUrl = function(){
    	var url = 'https://api.put.io/v2/oauth2/authenticate?client_id=1019&response_type=token&redirect_uri=http://filter.io/putio/'
    	return url;
    };

    return this;
  });
