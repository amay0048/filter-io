'use strict';

angular.module('doctaApp')
  .service('AppointmentFormModel', function AppointmentFormModel() {
    // AngularJS will instantiate a singleton by calling "new" on this function
    return ["TypeOfAppointment","ProviderType","Number","Note"];
  });