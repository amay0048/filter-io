'use strict';

/**
 * @ngdoc service
 * @name airplayPutioApp.localstorage
 * @description
 * # localstorage
 * Service in the airplayPutioApp.
 */
angular.module('airplayPutioApp')
  .service('LocalStorage', function LocalStorage($window) {
    // AngularJS will instantiate a singleton by calling "new" on this function

    return {
      set: function(key, value) {
        $window.localStorage[key] = value;
      },
      get: function(key, defaultValue) {
        return $window.localStorage[key] || defaultValue;
      },
      setObject: function(key, value) {
        $window.localStorage[key] = angular.toJson(value);
      },
      getObject: function(key) {
        return angular.fromJson($window.localStorage[key] || '{}');
      }
    }
  });
