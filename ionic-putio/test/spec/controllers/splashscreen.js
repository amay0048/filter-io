'use strict';

describe('Controller: SplashscreenCtrl', function () {

  // load the controller's module
  beforeEach(module('airplayPutioApp'));

  var SplashscreenCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    SplashscreenCtrl = $controller('SplashscreenCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
