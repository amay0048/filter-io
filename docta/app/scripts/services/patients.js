'use strict';

angular.module('doctaApp')
  .service('Patients', function Patients(PatientFormModel) {
    // AngularJS will instantiate a singleton by calling "new" on this function
    var Patient = Parse.Object.extend({
      className: 'Patient',
      attrs: PatientFormModel
    });

    return {
    	getPatients: function(){
            
        var query = new Parse.Query(Patient);

        return query.find({
          success: function(results) {
            console.log('Successfully retrieved ' + results.length + ' patients.');
          },
          error: function(error) {
            console.log('Error: ' + error.code + ' ' + error.message);
          }
        });

    	},
    	getPatientById: function(patientId){
        var query = new Parse.Query(Patient);

        return query.get(patientId,{
          success: function(results) {
            console.log('Successfully retrieved ' + results.length + ' patients.');
          },
          error: function(error) {
            console.log('Error: ' + error.code + ' ' + error.message);
          }
        });
    	},
    	createPatient: function(patientFormModel){
        var patient = new Patient();
         
        return patient.save(patientFormModel, {
          success: function(patient) {
            // The object was saved successfully.
            console.log(patient,'Success');
          },
          error: function(patient, error) {
            // The save failed.
            // error is a Parse.Error with an error code and description.
            console.log(patient,'Error',error);
          }
        });
    	},
      updatePatient: function(patientFormModel){
        var patient = new Patient();

        console.log(patient,PatientFormModel);
         
        return patient.save(patientFormModel, {
          success: function(patient) {
            // The object was saved successfully.
            console.log(patient,'Success');
          },
          error: function(patient, error) {
            // The save failed.
            // error is a Parse.Error with an error code and description.
            console.log(patient,'Error',error);
          }
        });
      }
    };
  });
