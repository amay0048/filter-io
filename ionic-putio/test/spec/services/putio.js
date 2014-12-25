'use strict';

describe('Service: putio', function () {

  // load the service's module
  beforeEach(module('airplayPutioApp'));

  // instantiate service
  var putio;
  beforeEach(inject(function (_putio_) {
    putio = _putio_;
  }));

  it('should do something', function () {
    expect(!!putio).toBe(true);
  });

});
