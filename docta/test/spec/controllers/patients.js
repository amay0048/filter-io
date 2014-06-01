'use strict';

describe('Controller: PatientsCtrl', function () {

  // load the controller's module
  beforeEach(module('doctaApp'));

  var PatientsCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    PatientsCtrl = $controller('PatientsCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
