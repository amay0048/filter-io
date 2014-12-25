'use strict';

describe('Service: localstorage', function () {

  // load the service's module
  beforeEach(module('airplayPutioApp'));

  // instantiate service
  var localstorage;
  beforeEach(inject(function (_localstorage_) {
    localstorage = _localstorage_;
  }));

  it('should do something', function () {
    expect(!!localstorage).toBe(true);
  });

});
