'use strict';

describe('Service: DownloadThread', function () {

  // load the service's module
  beforeEach(module('airplayPutioApp'));

  // instantiate service
  var DownloadThread;
  beforeEach(inject(function (_DownloadThread_) {
    DownloadThread = _DownloadThread_;
  }));

  it('should do something', function () {
    expect(!!DownloadThread).toBe(true);
  });

});
