'use strict';

/**
 * @ngdoc function
 * @name airplayPutioApp.controller:ListfilesCtrl
 * @description
 * # ListfilesCtrl
 * Controller of the airplayPutioApp
 */
angular.module('airplayPutioApp')
  .controller('ListfilesCtrl', function ($scope, $rootScope, $stateParams, $http, Putio) {
    
    $scope.fileId = 0;

    if(typeof $stateParams.fileId !== 'undefined' && $stateParams.fileId !== '')
    {
      $scope.fileId = $stateParams.fileId;
    }

    $scope.getLink = function(file){
      if(typeof file.content_type === 'undefined')
      {
        return '';
      }
      else if(file.content_type.indexOf('directory') < 0)
      {
        return '#/app/filedetail/'+file.id;
      }
      else
      {
        return '#/app/listfiles/'+file.id;
      }
    };

    $scope.files = [{
      name:'Loading...'
    }];

    Putio.listFiles($scope.fileId).then(function(files){
      $scope.files = files;
    },function(err){
      console.log(err);
    },function(files){
      if(Object.keys(files).length > 0)
      {
        $scope.files = files;
      }
    });
  });
