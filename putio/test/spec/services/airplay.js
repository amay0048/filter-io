'use strict';

describe('Service: airplay', function () {

  // load the service's module
  beforeEach(module('initApp'));

  // instantiate service
  var airplay;
  beforeEach(inject(function (_airplay_) {
    airplay = _airplay_;
  }));

  it('should do something', function () {
    expect(!!airplay).toBe(true);
  });

});
