var app_init = function(){

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

}