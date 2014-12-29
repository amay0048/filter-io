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
        error: false
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

    var deferred = {};
    Thread.prototype.start = function(){

      if(this.status.running)
      {
        return deferred.promise;
      }

      deferred = $q.defer();
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

      var transferComplete = (function(thread, deferred, oReq){
        return function (oEvent) {
          thread.file = new LocalFile(thread.filename);
          var blob = new Blob([oEvent.target.response]);
          thread.file.create(blob).then(function(){
            thread.status.running = false;
            thread.status.percent = 1;
            deferred.resolve(thread);
          });
        };        
      })(this, deferred, oReq);

      oReq.addEventListener('progress', updateProgress, false);
      oReq.addEventListener('load', transferComplete, false);
      oReq.addEventListener('error', transferFailed, false);
      oReq.addEventListener('abort', transferCanceled, false);

      var range = 'bytes='+this.range.start+'-';
      if(typeof this.range.end !== 'undefined')
      {
        range += this.range.end;
      }
      oReq.open('GET',this.url,true);
      oReq.setRequestHeader('Range', range);
      oReq.responseType = 'arraybuffer';
      oReq.send(null);

      function transferFailed(evt) {
        deferred.reject("An error occurred while transferring the file.");
      }

      function transferCanceled(evt) {
        deferred.reject("The transfer has been canceled by the user.");
      }

      return deferred.promise;
    };
    
    return Thread;
  });
