'use strict';

/**
 * @ngdoc service
 * @name airplayPutioApp.downloaderManager
 * @description
 * # downloaderManager
 * Service in the airplayPutioApp.
 */
angular.module('downloader.manager',['downloader.download'])
  .service('DownloadManager', function DownloadManager(Download) {

    var maxThreads = 5,
        maxDownloads = 1,
        _self = this;

    this.pending = [];
    this.active = [];
    this.complete = [];

    function processPending(){
      if(_self.active.length < maxDownloads && _self.pending.length)
      {
        _self.active.push(_self.pending.shift());
        processActive();
      }
    };

    function processActive(){
      if(_self.active.length)
      {
        var current = _self.active[0];
        current.start().then(function(download){
          processComplete();
        },function(err){
          processComplete();
          console.log(err);
        });
      }
    };

    function processComplete(){
      if(_self.active.length)
      {
        _self.complete.push(_self.active.shift());
      }
      processPending();
    };

    this.addDownload = function(url,options){
      var download = new Download(url,options);
      download.createThreads().then(function(download){
        _self.pending.push(download);
        processPending();
      });
    };

    return this;
  });
