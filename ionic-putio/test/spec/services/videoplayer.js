'use strict';

describe('Service: VideoPlayer', function () {

  // load the service's module
  beforeEach(module('airplayPutioApp'));

  // instantiate service
  var VideoPlayer;
  beforeEach(inject(function (_VideoPlayer_) {
    VideoPlayer = _VideoPlayer_;
  }));

  it('should do something', function () {
    expect(!!VideoPlayer).toBe(true);
  });

});
