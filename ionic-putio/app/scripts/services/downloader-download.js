'use strict';

/**
 * @ngdoc service
 * @name airplayPutioApp.downloaderDownload
 * @description
 * # downloaderDownload
 * Service in the airplayPutioApp.
 */
angular.module('downloader.download',['downloader.thread','downloader.file'])
  .factory('Download', function Downloader($q, DownloadThread, LocalFile) {

    // 20MB chunks
  	var chunk = 20 * Math.round(1.049 * Math.pow(10,6)),
        maxActiveThreads = 4;

    function checkURL(download){
      var deferred = $q.defer(),
          xhr = new XMLHttpRequest();

      xhr.open('HEAD', download.url, true);
      xhr.send(null);

      xhr.addEventListener('load', function(progress) {
        var responseURL = progress.target.responseURL;
        if(responseURL)
        {
          download.url = responseURL;
        }
        deferred.resolve(download); 
      });

      return deferred.promise;
    };

    function splitDownloadIntoThreads(download){
      var deferred = $q.defer(),
          xhr = new XMLHttpRequest();

      checkURL(download).then(function(){
        xhr.open('GET', download.url, true);
        xhr.send(null);
      });

      xhr.addEventListener('progress', function(progress) {
        if(progress.total>0 && download.totalSize != progress.total)
        {
          onXhrFirstDownloadProgress(progress);
          xhr.abort();
        }
      });

      function onXhrFirstDownloadProgress(progress){
        download.totalSize = progress.total; //bytes
        download.chunks = Math.ceil(download.totalSize/chunk);
        download.threads = [];
        var filename = download.options.name+'-part-';
        for(var i=0; i<download.chunks; i++)
        {
          var url = download.url,
              start = i*chunk, thread;
          if(i+1<download.chunks)
          {
            thread = new DownloadThread(filename+i,i,download.url,start,((i+1)*chunk)-1);
          }
          else
          {
            thread = new DownloadThread(filename+i,i,download.url,start);
          }
          download.threads.push(thread);
        }
        deferred.resolve(download);
      };

      return deferred.promise;
    };

    function updateActiveThreads(download, deferred){
      var threads = download.threads,
          max = angular.copy(maxActiveThreads);

      for(var i=0; i<threads.length; i++)
      {
        if(threads[i].status.running)
        {
          max--;
          continue;
        }
        else if(!threads[i].status.running && !threads[i].isComplete())
        {
          if(max > 0)
          {
            threads[i].start().then(function(thread){
              checkCompletion(download, deferred);
            },function(){
              checkCompletion(download, deferred);
            });
            max--;
          }
          else
          {
            break;
          }
        }
      }
    };

    function checkCompletion(download, deferred){
      var threads = download.threads,
          complete = true;

      processWorkingThreads(download);

      for(var i=0; i<threads.length; i++)
      {
        if(!threads[i].isComplete())
        {
          complete = false;
          break;
        }
      }

      if(!complete)
      {
        updateActiveThreads(download, deferred);
        deferred.notify(download);
      }
      else
      {
        download.status.running = false;
        download.status.complete = true;
        deferred.resolve(download);
      }
    };

    function processWorkingThreads(download){
      var threads = download.threads;

      for(var i=0; i<threads.length; i++)
      {
        if(threads[i].status.processed)
        {
          console.log('PROCESSED',threads[i].part);
          continue;
        }
        else if(threads[i].isComplete())
        {
          threads[i].processToFile(download.file).then(function(){
            processWorkingThreads(download);
          },function(){
            processWorkingThreads(download);
          });
          break;
        }
        else
        {
          break;
        }
      }

      return download;
    };

  	var Download = function(url, options){
      this.url = url;
  		this.options = options;
      this.status = {
        running: false,
        complete: false
      };
      this.threadsPointer = 0;
      this.file = new LocalFile(this.options.name);
      return this;
    };
    Download.prototype.createThreads = function(){
      return splitDownloadIntoThreads(this);
    };
    Download.prototype.threads = [];
    Download.prototype.getUrl = function(){
      return this.url;
    };
    Download.prototype.getName = function(){
      return this.options.name+'.mp4';
    };
    Download.prototype.start = function(){
      var deferred = $q.defer(),
          download = this;

      var blob = new Blob([], { type: 'video/mp4' });
      download.file = new LocalFile(download.options.name);
      download.file.create(blob).then(function(){
        updateActiveThreads(download, deferred);
      },function(err){
        updateActiveThreads(download, deferred);
      });

      return deferred.promise;
    };

    return Download;
  });
