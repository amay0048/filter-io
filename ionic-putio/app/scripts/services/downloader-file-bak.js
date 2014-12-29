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

    function fail(err){
      console.log('FILE ERROR',arguments);
      return;
    };

    function getFileEntry(file,callback){
      var filename = file.filename,
          path = file.path,
          self = file;
      
      window.resolveLocalFileSystemURL(path, onGetFileSystemURL, fail);

      function onGetFileSystemURL(fileSystemURL){
        fileSystemURL.filesystem.root.getFile(filename, {create: !self.exists, exclusive: true}, callback, function(err){
          if(err.code == 12)
          {
            self.exists = true;
            onGetFileSystemURL(fileSystemURL);
            console.log('12');
          }
          fail(err);
        });
        $timeout(function(){
          fileSystemURL = null;
        },300);
        return;
      };
      return;
    };

    function getFileContent(file, callback){
      getFileEntry(file,onGetFileEntry);

      function onGetFileEntry(fileEntry){
        fileEntry.file(onGetFile, fail);
        $timeout(function(){
          fileEntry = null;
        },60);
        return;
      };

      function onGetFile(file){
        readFileAsArray(file);
        return;
      };

      function readFileAsArray(file) {
        var reader = new FileReader();
        reader.onloadend = function (evt) {
          var result = new Uint8Array(evt.target.result);
          callback(result);
          reader = null;
          result = null;
          return;
        };
        reader.readAsArrayBuffer(file);
        return;
      };
    };

    function writeFile(file,blob,append,callback){
      var filename = file.filename,
          path = file.path,
          self = file;

      getFileEntry(file,onGetFileEntry);

      function onGetFileEntry(fileEntry){
        self.exists = true;
        console.log('CREATE:WRITER');
        fileEntry.createWriter(onGetFileWriter, fail);
        $timeout(function(){
          fileEntry = null;
        },60);
        return;
      };

      function onGetFileWriter(writer){
        file.writer = writer;

        if(!append)
        {
          writer.truncate(0);
          writer.onwriteend = function(evt){
            appendContent(writer,blob,callback);
          };
        }
        else
        {
          appendContent(writer,blob,callback);
        }
        return;
      };


      return;
    };

    function appendContent(writer,blob,callback){
      writer.onwriteend = function(evt){
        blob = null;
        console.log('write success');
        callback();
        return;
      };
      writer.seek(writer.length);
      writer.write(blob);
      return;
    };

    // Only for creating
    LocalFile.prototype.create = function(blob){
      var deferred = $q.defer();
      writeFile(this,blob,false, function(){
        deferred.resolve();
      });
      return deferred.promise;
    };
    // Only for appending
    LocalFile.prototype.append = function(blob){
      var deferred = $q.defer();
      writeFile(this,blob,true, function(){
        deferred.resolve();
      });
      return deferred.promise;
    };
    // Only for getting content
    LocalFile.prototype.getContent = function(){
      var deferred = $q.defer();
      getFileContent(this, function(content){
        deferred.resolve(content);
      });
      return deferred.promise;
    };
    LocalFile.prototype.getFullPath = function(){
      return this.path+this.filename;
    };
    
    return LocalFile;
  });
