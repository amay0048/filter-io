/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
var app = {
    // Application Constructor
    initialize: function() {
        this.bindEvents();
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function() {
        document.addEventListener('deviceready', this.onDeviceReady, false);
    },
    // deviceready Event Handler
    //
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicity call 'app.receivedEvent(...);'
    onDeviceReady: function() {
        app.receivedEvent('deviceready');
        var VideoView = Backbone.View.extend({
          // there are many different ways to do this, here's one
          tagName: 'div',
          className: 'video-item',
          // make an Underscore template for the inner HTML
          template: _.template(
            '<h2 class="name"><%= title %></h2>' +
            '<img class="banner" src="<%= img_src %>" >' +
            '<h3 class="title"><%= show %></h3>' +
            '<h3 class="season_number">Season: <%= season %></h3>' +
            '<h3 class="episode_number">Episode: <%= episode %></h3>' +
            '<p class="overview"><%= overview %></p>' +
            '<p>Filename: <%= name %></p>'
          ),
          render: function(){
            // this.el is already set to a tr.item-row DOM element
            $(this.el).html(
              // fill in the template with model attributes
              this.template(this.model.toJSON())
            );
            // allows chaining
            return this;
          }
          // ... now your events and handler as written
        });
        var VideosView = Backbone.View.extend({
        		collection: null,
            el: '#video_container',
	          initialize : function(){
						  _(this).bindAll('add', 'remove', 'change');

					    this._videoViews = [];

					    this.collection.each(this.add);
					    // bind this view to the add and remove events of the collection!
					    this.collection.bind('add', this.add);
					    this.collection.bind('remove', this.remove);
              this.collection.bind('change', this.change);
              alert('init');
						},
					  add : function(item) {
					    // We create an updating donut view for each donut that is added.
					    var dv = new VideoView({
					      model : item
					    });
					 
					    // And add it to the collection so that it's easy to reuse.
					    this._videoViews.push(dv);
					 
					    // If the view has been rendered, then
					    // we immediately append the rendered donut.
					    if (this._rendered) {
					      $(this.el).prepend(dv.render().el);
					    }
					  },
            change: function(item) {
              //console.log(item);
              this.remove(item);
              this.add(item);
            },
            remove : function(model) {
              var viewToRemove = _(this._videoViews).select(function(cv) { return cv.model.id === model.id; })[0];
              this._videoViews = _(this._videoViews).without(viewToRemove);
           
              if (this._rendered) $(viewToRemove.el).remove();
            },
            render: function() {
              // We keep track of the rendered state of the view
					    this._rendered = true;
					 
					    $(this.el).empty();
					 
					    // Render each Donut View and append them.
					    _(this._videoViews).each(function(dv) {
					      this.$('#video_container').append(dv.render().el);
					    });
					 
					    return this;
            }
        });
        var containerView = new VideosView({ collection: Videos });
        containerView.render();
    },
    // Update DOM on a Received Event
    receivedEvent: function(id) {
    	/*
      var parentElement = document.getElementById(id);
      var listeningElement = parentElement.querySelector('.listening');
      var receivedElement = parentElement.querySelector('.received');

      listeningElement.setAttribute('style', 'display:none;');
      receivedElement.setAttribute('style', 'display:block;');
       */
       
      console.log('Received Event: ' + id);
    }
};
