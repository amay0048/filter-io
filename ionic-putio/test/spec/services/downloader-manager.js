'use strict';

describe('Service: downloaderManager', function () {

  // load the service's module
  beforeEach(module('airplayPutioApp'));

  // instantiate service
  var downloaderManager;
  beforeEach(inject(function (_downloaderManager_) {
    downloaderManager = _downloaderManager_;
  }));

  it('should do something', function () {
    expect(!!downloaderManager).toBe(true);
  });

});
