'use strict';

angular.module('doctaApp')
  .service('Plans', function Plans(AppointmentFormModel) {

    var Parse = window.Parse;
    // AngularJS will instantiate a singleton by calling "new" on this function
    var Appointment = Parse.Object.extend({
      className: 'Appointment',
      attrs: AppointmentFormModel
    });

    var AppointmentsCollection = Parse.Collection.extend({
      model: Appointment
    });

    var Plan = Parse.Object.extend({
      className: 'Plan',
  	  defaults : {
  	    Name : 'Untitled'
  	  },
  	 
  	  initialize : function() {
  	    // When you extend a Parse.Model and give it an initialize function,
  	    // the function is called when you instantiate an instance of your Model.
  	    this.appointments = new AppointmentsCollection();
        Parse.Relation(this, 'appointments');
  	  },
      setName : function(newName){
        this.Name = newName;
      }
  	});

    return {

      getPlans: function(){
        var query = new Parse.Query(Plan);

        return query.find({
          success: function(results) {
            console.log('Successfully retrieved ' + results.length + ' plans.');
          },
          error: function(error) {
            console.log('Error: ' + error.code + ' ' + error.message);
          }
        });
      },
      getPlanById: function(plandId){
        var query = new Parse.Query(Plan);
        //query.include('appts');

        return query.get(plandId,{
          success: function(results) {
            console.log('Successfully retrieved ' + results.length + ' plans.');
          },
          error: function(error) {
            console.log('Error: ' + error.code + ' ' + error.message);
          }
        });
      },
      createPlan: function(planFormModel){
        var plan = new Plan(planFormModel);
        
        return plan.save(null, {
          success: function(plan) {
            // The object was saved successfully.
            console.log(plan,'Success');
          },
          error: function(plan, error) {
            // The save failed.
            // error is a Parse.Error with an error code and description.
            console.log(plan,'Error',error);
          }
        });
      },
      updatePlan: function(plan){
        return plan.save({
          success: function(plan) {
            // The object was saved successfully.
            console.log(plan,'Success');
          },
          error: function(plan, error) {
            // The save failed.
            // error is a Parse.Error with an error code and description.
            console.log(plan,'Error',error);
          }
        });
      },
      getAppointments: function(plan){
        return plan.relation('appointments').query().ascending('Number').find();
      },
      createAppointment: function(appointmentFormModel){
        var appointment = new Appointment(appointmentFormModel);

        return appointment.save(null, {
          success: function(resp) {
            // The object was saved successfully.
            console.log(resp,'Success');
          },
          error: function(resp, error) {
            // The save failed.
            // error is a Parse.Error with an error code and description.
            console.log(resp,'Error',error);
          }
        });
      },
      updateAppointment: function(appointment){
        return appointment.save({
          success: function(resp) {
            // The object was saved successfully.
            console.log(resp,'Success');
          },
          error: function(resp, error) {
            // The save failed.
            // error is a Parse.Error with an error code and description.
            console.log(resp,'Error',error);
          }
        });
      }

    };

  });
