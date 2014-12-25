try
{
	var link = document.getElementById('mp4-download').childNodes[1].href;
}
catch (err)
{
	var link = document.getElementsByClassName('movie-download')[1].childNodes[0].href;	
}
// link = link.replace('download','hls/media.m3u8');

var airplayButtonOnClick = function(){
	chrome
		.runtime
			.sendMessage('epmmcmaebfecdakhmhlfdnjdgnifjmig',{
				mpfour:link,
				metaInfo:window.metaInfo
			});
};

var header = document.getElementById('header'),
	contentDiv = document.createElement('div');

var injectData = function(title, image, background, width, overview){

	var t 		 = document.createTextNode(title),
		over 	 = document.createTextNode(overview),
		h 		 = document.createElement('h2'),
		img 	 = document.createElement('img'),
		p 		 = document.createElement('p'),
		hspace 	 = document.createElement('br'),
		imgSpace = document.createElement('br'),
		pspace 	 = document.createElement('br'),
		airBtn 	 = document.createElement('button'),
		airTxt	 = document.createTextNode('Air Play');

	contentDiv.style.textAlign = 'center';
	document.body.style.backgroundImage = 'url(\''+background+'\')';
	document.body.style.backgroundSize = 'cover';

	document.getElementById('content').style.marginTop = '350px';
	document.getElementById('content').style.background = 'rgba(255,255,255,0.7)';
	document.getElementById('subheader').style.background = 'transparent';
	
	airBtn.type = 'button';
	airBtn.vaue = 'Airplay';
	airBtn.id = 'AirplayButton';
	airBtn.className = 'lebutton halo';
	airBtn.onclick = airplayButtonOnClick;
	airBtn.appendChild(airTxt);
	document
		.getElementById('subheader-menu')
			.appendChild(airBtn);

	img.src = image;
	img.style.width = width;
	contentDiv.appendChild(img);
	contentDiv.appendChild(imgSpace);
	contentDiv.appendChild(hspace);

	h.appendChild(t);
	h.style.textAlign = 'left';
	contentDiv.appendChild(h);

	p.appendChild(over);
	p.style.textAlign = 'left';
	contentDiv.appendChild(p);
	contentDiv.appendChild(pspace);

	// insertAfter(contentDiv, header);
	var right = document.getElementsByClassName('first-right-box');
	right[0].parentNode.insertBefore(contentDiv, right[0]);
};

function insertAfter(newNode, referenceNode) {
    referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}

window.injectMovieData = function(data){
	window.metaInfo = data;
	console.log(data);
	injectData(data.title, data.images.poster, data.images.fanart, '50%', data.overview);
}

window.injectEpisodeData = function(data){
	window.metaInfo = data;
	console.log(data);
	injectData(data.title, data.screen, window.trakt.images.fanart, '100%', data.overview);
}

