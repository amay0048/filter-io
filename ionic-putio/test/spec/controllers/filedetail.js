'use strict';

describe('Controller: FiledetailCtrl', function () {

  // load the controller's module
  beforeEach(module('airplayPutioApp'));

  var FiledetailCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    FiledetailCtrl = $controller('FiledetailCtrl', {
      $scope: scope
    });
  }));

  it('should attach a list of awesomeThings to the scope', function () {
    expect(scope.awesomeThings.length).toBe(3);
  });
});
