'use strict';

describe('Service: downloaderFile', function () {

  // load the service's module
  beforeEach(module('airplayPutioApp'));

  // instantiate service
  var downloaderFile;
  beforeEach(inject(function (_downloaderFile_) {
    downloaderFile = _downloaderFile_;
  }));

  it('should do something', function () {
    expect(!!downloaderFile).toBe(true);
  });

});
