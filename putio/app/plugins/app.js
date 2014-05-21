// Hello, welcome to your new Framer project. This is where you should 
// start coding. Feel free to remove all of this code.
// 
// Just to rehash: Framer just converted all your layer groups into framer
// views. Just drop index.html (next to this file) on your browser to see
// the result. Every view is available under the global PSD object, so if you
// had a layer group called MyPhoto you can find it under PSD["MyPhoto"].
// 
// You can safely re-run the Framer app any time and this code will stay 
// intact. Framer will only update the graphics.
// 
// Some links that could come in handy:
// 
// 	- Docs: 	http://www.framer.com/documentation
// 	- Examples: http://www.framer.com/examples


// ==============================================================
// Example: bounce all the views!


// Simple reusable function that binds a bounce to a click on a view
function bounceOnClick(view) {
	
	// If the view is a normal view (not a scrollview)
	if (view instanceof View) {
		
		// Listen to a click event
		view.on("click", function(event) {
			
			// Stop sending the click event to underlying views after this
			event.stopPropagation();
			
			// "Wind up" the spring
			view.scale = 0.7;
			
			// And scale back to full size with a spring curve
			view.animate({
				properties:{scale:1.0},
				curve: "spring(1000,15,500)"
			});
		});
	}
}

// Loop through all the exported views
for (var layerGroupName in PSD) {
	bounceOnClick(PSD[layerGroupName]);
}

var $tiles = PSD.tiles;

$tiles.yAxis = $tiles.y;
$tiles.draggable = new ui.Draggable($tiles);

$tiles.on(Events.DragMove, function(event) {
  $tiles.y = $tiles.yAxis;

  /* These are two variables you can tweak for different effects */
  var animation, constant1, constant2, totalVelocity, velocity;
  constant1 = 1000;
  constant2 = 0;

  /* Calculate the current dragging velocity and add x and y up */
  velocity = $tiles.draggable.calculateVelocity();
  totalVelocity = Utils.pointTotal(Utils.pointAbs(velocity));

  /* The momentum animation is actually a spring animation with
  	very high friction. You can change the the other spring
  	values for different effects
   */
  return animation = $tiles.animate({
    properties: {
      x: parseInt($tiles.x + (velocity.x * constant1)),
      y: parseInt($tiles.y + (velocity.y * constant1))
    },
    curve: "spring",
    curveOptions: {
      friction: 100,
      tension: 80,
      velocity: totalVelocity * constant2
    }
  });
});

