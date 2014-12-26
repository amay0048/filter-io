'use strict';

/**
 * @ngdoc service
 * @name airplayPutioApp.downloaderDownload
 * @description
 * # downloaderDownload
 * Service in the airplayPutioApp.
 */
angular.module('downloader.download',['downloader.thread'])
  .factory('Download', function Downloader($q, DownloadThread) {

  	var chunk = 100 * Math.round(1.049 * Math.pow(10,6)); //100 MB

    var checkURL = function(download){
      var deferred = $q.defer(),
          xhr = new XMLHttpRequest();

      xhr.open('HEAD', download.url, true);
      xhr.send(null);

      xhr.addEventListener('load', function(progress) {
        var responseURL = progress.target.responseURL;
        download.url = responseURL;
        deferred.resolve(download); 
      });

      return deferred.promise;
    };

    var chunkThreads = function(download){
      var deferred = $q.defer(),
          xhr = new XMLHttpRequest();

      checkURL(download).then(function(){
        xhr.open('GET', download.url, true);
        xhr.send(null);
      });

      xhr.addEventListener('progress', function(progress) {
        if(progress.total>0 && download.totalSize != progress.total)
        {
          setTotal(progress);
          xhr.abort();
        }
      });

      var setTotal = function(progress){
        download.totalSize = progress.total; //bytes
        download.chunks = Math.ceil(download.totalSize/chunk);
        download.threads = [];
        for(var i=0; i<download.chunks; i++)
        {
          var url = download.url,
              start = i*chunk, thread;
          if(i+1<download.chunks)
          {
            thread = new DownloadThread(download.url,start,((i+1)*chunk)-1);
          }
          else
          {
            thread = new DownloadThread(download.url,start);
          }
          download.threads.push(thread);
        }
        deferred.resolve(download);
      };

      return deferred.promise;
    };

  	var Download = function(url, options){
      this.url = url;
  		this.options = options;
      this.status = {
        running: false
      };
      return this;
    };
    Download.prototype.createThreads = function(){
      return chunkThreads(this);
    };
    Download.prototype.threads = [];
    Download.prototype.getUrl = function(){
      return this.url;
    };
    Download.prototype.start = function(){
      if(this.status.running)
      {
        return;
      }

      this.status.running = true;
      for(var i=0; i<this.threads.length; i++)
      {
        this.threads[i].start();
      }
    };

    return Download;
  });
