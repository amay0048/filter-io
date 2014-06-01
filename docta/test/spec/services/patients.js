'use strict';

describe('Service: Patients', function () {

  // load the service's module
  beforeEach(module('doctaApp'));

  // instantiate service
  var Patients;
  beforeEach(inject(function (_Patients_) {
    Patients = _Patients_;
  }));

  it('should do something', function () {
    expect(!!Patients).toBe(true);
  });

});
