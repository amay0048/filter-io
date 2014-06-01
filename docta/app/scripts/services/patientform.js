'use strict';

angular.module('doctaApp')
  .service('PatientFormModel', function PatientFormModel() {
    // AngularJS will instantiate a singleton by calling "new" on this function
    return ["FullName2","Provider","Location","Week10TimeandDate","TimeandDate","ReminderFrequency"];
  });