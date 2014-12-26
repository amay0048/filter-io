'use strict';

describe('Service: Downloader', function () {

  // load the service's module
  beforeEach(module('airplayPutioApp'));

  // instantiate service
  var Downloader;
  beforeEach(inject(function (_Downloader_) {
    Downloader = _Downloader_;
  }));

  it('should do something', function () {
    expect(!!Downloader).toBe(true);
  });

});
