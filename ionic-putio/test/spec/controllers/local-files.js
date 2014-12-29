'use strict';

describe('Controller: LocalFilesCtrl', function () {

  // load the controller's module
  beforeEach(module('airplayPutioApp'));

  var LocalFilesCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    LocalFilesCtrl = $controller('LocalFilesCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
