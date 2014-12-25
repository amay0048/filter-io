var fileName = document.title;

var maskEpisode = /(.+?)[Ss](\d+)[Ee](\d+)|(.+?)(\d{1,2})x(\d{1,2})|(.+?)season.*?(\d{1,2}).*?episode.*?(\d{1,2})/i;
var matchEpisode = fileName.match(maskEpisode);

var maskMovie = /(.+?)(\d\d\d\d)/i;
var matchMovie = fileName.match(maskMovie);

var item = window.item = {};

var addMovieMeta = function(item,match){
  match = match.toString().replace(/[,]+/g,',').split(',');
  item.name = match[1].replace(/\W+/ig,' ').trim();
  item.key = sanatise(match[1]);

  return item;
};

var movieLookup = function(item){
	var name = item.name,
		key = item.key,
		cbScript = document.createElement('script');

	cbScript.src = '//api.trakt.tv/search/movies.json/f4980e1fa96b6e330e1ca87430a33160?query='+name+'&limit=1&callback=traktMovieCB';
	document.head.appendChild(cbScript);
};

var addEpisodeMeta = function(item,match){
  match = match.toString().replace(/[,]+/g,',').split(',');
  item.name = match[1].replace(/\W+/ig,' ').trim();
  item.key = sanatise(match[1]);
  item.season = Number(match[2].trim());
  item.episode = Number(match[3].trim());

  return item;
};

var serialLookup = function(item){
	var name   = item.name,
		key    = item.key,
		season = item.season,
		cbScript = document.createElement('script');

	cbScript.src = '//api.trakt.tv/search/shows.json/f4980e1fa96b6e330e1ca87430a33160?query='+name+'&limit=1&callback=traktSeriesCB';
	document.head.appendChild(cbScript);
};

var episodesLookup = function(trakt){
	window.trakt = trakt;
	
	var slug = trakt.url.split('/').pop(),
		season = window.item.season;

	var cbScript = document.createElement('script');
	cbScript.src = '//api.trakt.tv/show/season.json/f4980e1fa96b6e330e1ca87430a33160/'+slug+'/'+season+'?callback=traktSeasonCB';
	document.head.appendChild(cbScript);
};

var sanatise = function(string){
  return string.replace(/\W+/ig,' ').trim().replace(/\bus$|\buk$|\b\d\d\d\d$/ig,' ').trim().toLowerCase();
};

window.traktMovieCB = function(response){
	if(response.length){
		window.injectMovieData(response[0]);
	}
};

window.traktSeriesCB = function(response){
	if(response.length){
		episodesLookup(response[0]);
	}
};

window.traktSeasonCB = function(response){
	var episode = window.item.episode;
	if(response.length){
		window.injectEpisodeData(response[episode-1]);
	}
};

if(matchEpisode)
{
  item = addEpisodeMeta(item,matchEpisode);
  serialLookup(item);
} 
else if(matchMovie)
{
  item = addMovieMeta(item,matchMovie);
  movieLookup(item);
}