var myLayers = window.Framer.Importer.load("imported/01 Map View");

// Demo code
// Bounce all the views
/*
for (layerName in myLayers) {

	var layer = myLayers[layerName];

	layer.on(Events.Click, function(event, layer) {
		
		// Wind up the layer by making it smaller
		layer.scale = 0.7

		// Animate the layer back to the original size with a spring
		layer.animate({
			properties: {scale:1.0},
			curve: "spring",
			curveOptions: {
				friction: 15,
				tension: 1000,
			}
		})

		// Only animate this layer, not other ones below
		event.stopPropagation()
	})
}
*/

var U = {
	forEach: function(array,callback){
		for(var i = 0;i < array.length; i++){
			callback(array[i],i);
		}
	},
	iniPos: function(layer,xOffset,yOffset){
		layer.iniPos = {
			x: layer.x,
			y: layer.y
		};
		layer.x += xOffset;
		layer.y += yOffset;
	}
};

var $sliderHandle = myLayers['slider-handle'];
U.iniPos($sliderHandle,0,0);
$sliderHandle.draggable.enabled = true;
$sliderHandle.draggable.speedY = 0;

var $locator = myLayers['Locate Icon'];
U.iniPos($locator,0,0);

$locator.on(window.Events.Click,function(){
	initialise();
});

var $overlay = myLayers.Overlay;
$overlay.x = -300;
$overlay.y = -600;
$overlay.scale = 4;

var pins = [];
var pinlLength = 7;

for(var i = 0;i < pinlLength;i++){
	pins[i] =  window['$pin'+Number(i+1)] = myLayers['Pin-'+Number(i+1)];
	U.iniPos(pins[i],0,-1080);
}

var $author = myLayers['Author Pin'];

U.iniPos($author,0,-1080);

var initialise = function(){
	$overlay.animate({
		properties: {
			x:0,
			y:0,
			scale:1
		},
		curve: "spring",
		curveOptions: {
			friction: 18,
			tension: 100,
			velocity: 0
		},
		delay:1.2
	});

	$author.animate({
		properties: {
			y: $author.iniPos.y
		},
		curve: "spring",
		curveOptions: {
			friction: 12,
			tension: 110,
			velocity: 8
		}
	});

	U.forEach(pins,function(item,index){
		item.animate({
			properties: {
				y: item.iniPos.y
			},
			curve: "spring",
			curveOptions: {
				friction: 11,
				tension: 110,
				velocity: 8
			},
			delay:2+index/5
		});
	});
};

alert('Touch the locator in the lower left to see some animation');