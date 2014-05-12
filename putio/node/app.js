var global = {};
global.token = 'IK4Q6CE2';
global.tvdb_key = "F686E194A86D510C";

//var logfmt = require("logfmt");
var request = require("browser-request");
var parseString = require('xml2js').parseString;

var async = require("async");

var PutIO = require('put.io-v2');
var MovieDB = require('moviedb')('e03d61c9f4ef39cc972b654ae8d0f937');
var TVDB = require("tvdb");
var tvdb = new TVDB({ apiKey: global.tvdb_key });

api = new PutIO(global.token);

MovieDB.configuration(function(err,data){
	mdbconfig = data;
});

window.Backbone = Backbone = require("backbone");
Backbone.LocalStorage = require("backbone.localstorage");

window.Video = Video = Backbone.Model.extend({
    defaults: {
        name: 'filename',
        title: 'n/a',
		show: 'n/a',
		season: 'n/a',
		episode: 'n/a',
        img_src: '',
        overview: 'n/a',
		path: 'n/a'
    },
});
window.VideoCollection = VideoCollection = Backbone.Collection.extend({
	localStorage: new Backbone.LocalStorage("VideoCollection"),
	model: Video
});
window.Videos = Videos = new VideoCollection;

window.load = {
	start: function(){
		if(window.NProgress)
			NProgress.start();
		return true;
	},
	tick: function(){
		this.total += this.rate;
		if(window.NProgress)
			NProgress.set(this.total);
		return true;
	},
	complete: function(){
		if(window.NProgress)
			NProgress.done(true);
		return true;
	},
	rate: 0.08,
	total: 0.08
};

Videos.on("add", function(item) {
  //console.log(item.get("name") + " added by Backbone.");
  add_meta(item);
  window.load.tick();
});

Videos.on("change", function(item) {
  //console.log(item.get("name") + " changed by Backbone.");
});

window.load.start();

window.files = function(data){

	async.each(data.files, function(item, callback){

		//window.load.rate = 1/data.files.length;				
		add_local(item,callback);
		
	},function(err){
		window.load.complete();
		console.log("put.io scan completed");
		//console.log(output);
	});

};

add_local = function(item,callback){
	var uri;
	if(!item.is_mp4_available){
		uri = 'https://put.io/v2/files/'+item.id+'/stream?'+'token='+global.token;
	} else {
		uri = 'https://put.io/v2/files/'+item.id+'/mp4/stream?'+'token='+global.token;
	}

	/*
	request({uri:uri,method:'HEAD',Origin:'http://filter.io/'},function(e, request, body){
		if(request.statusCode < 400){
			if(typeof Videos.findWhere({id:item.id}) === 'undefined'){
				Videos.add([item]);
			}
		}
		callback(null);
	});
	*/
	Videos.add([item]);
	callback(null);
}

add_meta = function(item){
	if(item.get('content_type').match(/video/i)){//if it's a video, try to look it up
		var mask = item.get('name').match(/(.+?)[Ss](\d+)[Ee](\d+)|(.+?)(\d{1,2})x(\d{1,2})|(.+?)season.*?(\d{1,2}).*?episode.*?(\d{1,2})/i);
		if(mask){//Item has a tvseries naming structure so look up on TVDB
			async.waterfall([
				function(callback){
					tvlookup(mask, item, callback);
				},
				function(data,callback){
					episodelookup(item, callback);
				}
			]);

		} else if (item.get('name').match(/(.+?)(\d\d\d\d)/i)){//it's probably a movie to check out moviedb
			movielookup(item);
		}
	}
}

tvlookup = function(mask,item,callback){

	mask = mask.toString().replace(/[,]+/g,",").split(",");
	
	var name = mask[1].replace(/\W+/ig," ").trim();
	var season = mask[2].trim();
	var episode = mask[3].trim();

	season = Number(season);
	episode = Number(episode);
	
	item.set({show: name});
	item.set({season: season});
	item.set({episode: episode});

	var options = {
		hostname: 'api.trakt.tv',
		port: 80,
		path: '/search/shows.json/f4980e1fa96b6e330e1ca87430a33160?query='+encodeURI(name),
		method: 'GET'
	};
	var uri = 'http://'+options.hostname+options.path;
	
	request({uri:uri,json:true},function(e, response, body){

		try{
			var trkt = body;
			if(typeof trkt !== 'undefined') {
				item.set({show: trkt[0].title});
				item.set({img_src: trkt[0].images.fanart});
				item.set({trkt: trkt[0]});
			}
		} catch(e){
			console.log(options);
			console.log(body);
			console.log(e);
		} finally {
			callback(null,item);
			return item;
		}
	});

}

episodelookup = function (item,callback){
	if(typeof item.get('trkt') !== 'undefined') {

		//amay this function has been hacked and needs to be fixed
		var uri = tvdb.getInfoEpisodeDefault(item.get('trkt').tvdb_id, item.get('season'), item.get('episode'), function(err, resp){});

		request(uri,function(e, request, body){

			parseString(body, function (err, result) {
				if(typeof result !== 'undefined') {
					item.set({title: result.Data.Episode[0].EpisodeName[0]});
					item.set({img_src: 'http://thetvdb.com/banners/'+
						result.Data.Episode[0].filename[0]});
					item.set({overview: result.Data.Episode[0].Overview[0]});
					item.set({tvdb: result.Data});
				}

				callback(null,item);
			});
		});
	} else {
		callback(null,item);
	}

}

movielookup = function(item){
	var reg = item.get('name').match(/(.+?)(\d\d\d\d)/i);
	var name = reg[1].replace(/[.]/g,' ').trim();
	var year = reg[2];
	
	var options = {
		hostname: 'api.trakt.tv',
		port: 80,
		path: '/search/movies.json/f4980e1fa96b6e330e1ca87430a33160?query='+encodeURI(name),
		method: 'GET'
	};
	var uri = 'http://'+options.hostname+options.path;
	
	MovieDB.searchMovie({query: encodeURI(name) }, function(err, res){
  	console.log(res);
	});

	request(uri,function(e, request, body){

		try{
			var trkt = body;
			if(typeof trkt !== 'undefined') {
				item.set({trkt:trkt[0]});
			}
		} catch(e){
			console.log(options);
			console.log(body);
			console.log(e);
		} finally {
			return item;
		}
	});
}