'use strict';
angular.module('airplayPutioApp')

.controller('MenuCtrl', function($scope, $ionicModal, $rootScope, $timeout, Putio) {

  $rootScope.$watch('loggedin',function(value){
    $scope.loggedin = value;
  });

  // Triggered in the login modal to close it
  $scope.closeLogin = function() {
    $scope.modal.hide();
  },

  // Open the login modal
  $scope.login = function() {
    var ref = window.open(Putio.loginUrl(), '_blank', 'location=no');
    
    ref.addEventListener('loadstart', function(event) {
        if((event.url).indexOf('http://filter.io/putio/') == 0)
        {
            requestToken = (event.url).split('access_token=')[1];
            $rootScope.token = requestToken;
            $rootScope.loggedin = $scope.loggedin = true;
            ref.close();
        }
    });
  };

});
