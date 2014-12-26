'use strict';

describe('Service: downloaderDownload', function () {

  // load the service's module
  beforeEach(module('airplayPutioApp'));

  // instantiate service
  var downloaderDownload;
  beforeEach(inject(function (_downloaderDownload_) {
    downloaderDownload = _downloaderDownload_;
  }));

  it('should do something', function () {
    expect(!!downloaderDownload).toBe(true);
  });

});
