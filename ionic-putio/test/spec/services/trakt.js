'use strict';

describe('Service: trakt', function () {

  // load the service's module
  beforeEach(module('airplayPutioApp'));

  // instantiate service
  var trakt;
  beforeEach(inject(function (_trakt_) {
    trakt = _trakt_;
  }));

  it('should do something', function () {
    expect(!!trakt).toBe(true);
  });

});
