'use strict';

var href = window.location.href;
var index = href.indexOf('put.io');

if(index + 1){

	var scriptTempl = document.createElement('script');
	scriptTempl.src = chrome.extension.getURL('scripts/template.js');

	(document.head||document.documentElement).appendChild(scriptTempl);
	scriptTempl.onload = function() {
	    scriptTempl.parentNode.removeChild(scriptTempl);
	};

	var scriptInj = document.createElement('script');
	scriptInj.src = chrome.extension.getURL('scripts/injected.js');

	(document.head||document.documentElement).appendChild(scriptInj);
	scriptInj.onload = function() {
	    scriptInj.parentNode.removeChild(scriptInj);
	};

}