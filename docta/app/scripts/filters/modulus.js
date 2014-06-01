'use strict';

angular.module('doctaApp')
  .filter('modulus', function () {
    return function (items,mod) {
      if (items) {
          var finalItems = [],
              thisGroup;
          for (var i = 0; i < items.length; i++) {
              if (!thisGroup) {
                  thisGroup = [];
              }
              thisGroup.push(items[i]);
              if (((i+1) % mod) === 0) {
                  finalItems.push(thisGroup);
                  thisGroup = null;
              }
          }
          if (thisGroup) {
              finalItems.push(thisGroup);
          }
          return finalItems;
      }
    };
  });
