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
    this.threads = [];

    var processActive = function(){
      if(_self.active.length)
      {
        var current = _self.active[0];
        current.start();
      }
    };

    var processPending = function(){
      if(_self.active.length < maxDownloads && _self.pending.length)
      {
        _self.active.push(_self.pending.shift());
        processActive();
      }
    };

    this.addDownload = function(url){
      var download = new Download(url);
      download.createThreads().then(function(download){
        _self.pending.push(download);
        processPending();
      });
    };

    return this;
  });
