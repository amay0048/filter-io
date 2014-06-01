'use strict';

describe('Filter: modulus', function () {

  // load the filter's module
  beforeEach(module('doctaApp'));

  // initialize a new instance of the filter before each test
  var modulus;
  beforeEach(inject(function ($filter) {
    modulus = $filter('modulus');
  }));

  it('should return the input prefixed with "modulus filter:"', function () {
    var text = 'angularjs';
    expect(modulus(text)).toBe('modulus filter: ' + text);
  });

});
