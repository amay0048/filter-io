'use strict';

/**
 * @ngdoc service
 * @name airplayPutioApp.DownloadThread
 * @description
 * # DownloadThread
 * Factory in the airplayPutioApp.
 */
angular.module('downloader.thread',[])
  .factory('DownloadThread', function ($q, LocalFile) {

    var Thread = function(filename, part, url, start, end){
      this.url = url;
      this.part = part;
      this.range = {
        start: start
      };
      this.status = {
        running: false,
        percent: 0,
        processed: false
      };
      this.filename = filename;
      
      if(typeof end !== 'undefined')
      {
        this.range.end = end;
      }
      return this;
    };

    Thread.prototype.getRange = function(){
      return this.range;
    };

    Thread.prototype.isComplete = function(){
      if(this.status.percent < 1)
      {
        return false;
      }
      else if(this.status.running)
      {
        return false;
      }
      else
      {
        return true;
      }
    };

    Thread.prototype.start = function(){

      var deferred = $q.defer();
      this.status.running = true;
      var oReq = new XMLHttpRequest();

      var updateProgress = (function(thread,deferred){
        return function (oEvent) {
          if (oEvent.lengthComputable) {
            var percentComplete = oEvent.loaded / oEvent.total;
            thread.status.running = true;
            thread.status.percent = percentComplete;
            deferred.notify(percentComplete);
          } else {
            deferred.notify(oEvent);
          }
        };
      })(this, deferred);

      var transferComplete = (function(thread, deferred){
        return function (oEvent) {
          thread.status.running = false;
          thread.status.percent = 1;
          deferred.resolve(thread);
        };        
      })(this, deferred);

      var transferError = (function(thread, deferred){
        return function (err) {
          thread.status.running = false;
          thread.status.percent = 0;
          deferred.reject(err);
          console.log('download error source ' + err.source);
          console.log('download error target ' + err.target);
          console.log('upload error code ' + err.code);
        };        
      })(this, deferred);

      var range = 'bytes='+this.range.start+'-';
      if(typeof this.range.end !== 'undefined')
      {
        range += this.range.end;
      }

      var fileTransfer = new FileTransfer();
      var uri = encodeURI(this.url);

      fileTransfer.onprogress = updateProgress;

      this.file = new LocalFile(this.filename);
      this.file.create().then(function(cdvFile){
        var fileURL = cdvFile.localURL;

        fileTransfer.download(
          uri,
          fileURL,
          transferComplete,
          transferError,
          false,
          {
            headers: {
              'Range': range
            }
          }
        );
      },function(err){
        deferred.reject(err);
      });

      return deferred.promise;
    };

    Thread.prototype.processToFile = function(baseFile){
      var deferred = $q.defer(),
          thread = this;

      baseFile.appendFile(thread.file).then(function(bytesWritten){
        thread.status.processed = true;
        deferred.resolve(bytesWritten);
        thread.file.remove(function(fileEntry){},function(){});
      },fail);

      function fail(err){
        deferred.reject(err);
      };

      return deferred.promise;
    };
    
    return Thread;
  });
