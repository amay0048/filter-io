'use strict';

describe('Service: Plans', function () {

  // load the service's module
  beforeEach(module('doctaApp'));

  // instantiate service
  var Plans;
  beforeEach(inject(function (_Plans_) {
    Plans = _Plans_;
  }));

  it('should do something', function () {
    expect(!!Plans).toBe(true);
  });

});
