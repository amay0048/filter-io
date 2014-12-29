'use strict';

/**
 * @ngdoc service
 * @name airplayPutioApp.downloaderFile
 * @description
 * # downloaderFile
 * Factory in the airplayPutioApp.
 */
angular.module('downloader.file',[])
  .factory('LocalFile', function ($q, $timeout) {

    var LocalFile = function(filename){
      this.type = 'video/mp4';
      this.filename = filename+'.mp4';
      this.path = cordova.file.documentsDirectory+'NoCloud/';
      this.exists = false;
      return this;
    };

    function getFileEntry(localFile,create){
      var deferred = $q.defer();

      window.resolveLocalFileSystemURL(localFile.path, function(fileSystemURL){
        fileSystemURL.filesystem.root.getFile(
          localFile.filename,
          {create: create, exclusive: false},
          function(fileEntry){
            deferred.resolve(fileEntry);
          },
          fail
        );
      }, fail);

      function fail(err){
        deferred.reject(err);
      };

      return deferred.promise;
    };
    function getFile(localFile,create){
      var deferred = $q.defer();

      getFileEntry(localFile,create).then(function(fileEntry){
        fileEntry.file(function(file){
          deferred.resolve(file);
        },fail);
      },fail);

      function fail(err){
        deferred.reject(err);
      };

      return deferred.promise;
    };

    LocalFile.prototype.create = function(){
      var deferred = $q.defer(),
          thisFile = this;

      getFile(thisFile,true).then(function(file){
        deferred.resolve(file);
      },function(err){
        deferred.reject(err);
      });

      return deferred.promise;
    };
    LocalFile.prototype.remove = function(){
      var deferred = $q.defer(),
          thisFile = this;

      getFileEntry(thisFile,false).then(function(fileEntry){
        fileEntry.remove(function(entry){
          deferred.resolve(entry);
        },fail);
      },fail);

      function fail(err){
        debugger;
        deferred.reject(err);
      };

      return deferred.promise;
    };
    LocalFile.prototype.appendFile = function(file){
      var deferred = $q.defer(),
          thisFile = this;

      getFile(thisFile,false).then(function(baseFile){
        getFile(file,false).then(function(appendFile){
          LargeFiles.appendFile(baseFile.localURL, appendFile.localURL, function(bytesWritten){
            deferred.resolve(bytesWritten);
          },fail);
        },fail);
      },fail);

      function fail(err){
        deferred.reject(err);
      };

      return deferred.promise;
    };
    LocalFile.prototype.getContent = function(){
      var deferred = $q.defer(),
          thisFile = this;

      getFile(thisFile,false).then(function(){
        var reader = new FileReader();
        reader.onloadend = function (evt) {
          deferred.resolve(evt.target.result);
        };
        reader.readAsArrayBuffer(file);
      },function(err){
        deferred.reject(err);
      });

      return deferred.promise;
    };
    LocalFile.prototype.getFullPath = function(){
      return this.path+this.filename;
    };

    return LocalFile;
  });
