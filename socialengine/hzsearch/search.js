var logQuery = true;
var hash = window.location.hash;

/*
$(function(){
	
	$("#text").on('keyup',function () {
		setCount();
	});
	
	var setCount = function() {
		var limit = 100;
		var src = $('#text');
		var elem = $('#chars');
		var chars = src.val().length;
		
		if (chars > limit) {
			src.value = src.value.substr(0, limit);
			chars = limit;
		}
		elem.html( limit - chars );
	}
	
	$('.query').click(function(){
		$('#tags_1').importTags('');
		$('#text').val($(this).html().trim()).trigger('keyup');
		$('#searchForm').submit();
		return false;
	});
	
	// looking for initial hash
	if(hash.length){
		hash = decodeURIComponent(hash.split("#").pop());
		$('#text').val(hash).parent().submit();
	}
	
});
*/

var searchTags = new Array();

var doSearch = function(){
	preventSearchOnTagChange = true;
	var text = demo_text = $('#searchText').val();
	displayProviders();
	text = text.replace(/[^a-z0-9\s]/gi, '');
	searchTags = [];
	linguisticTags(text,updateTags);
	return false;
}


var addQuestion = function(questionstring){
	$.ajax("http://hoozoo.azurewebsites.net/hoozoo/api/question.aspx", {
		type: "POST",
		dataType: "jsonp",
		data: { method: "add", question: questionstring },
		success: function (data, status) {
			if (data != null) {
				console.log("Added question, guid = " + data.questionGuid);
				console.log(data);
				if(_jf){
					_jf.options.iframeParameters.guid = data.questionGuid;
				}
			} else {
				console.log(qlist[j]['Title']);
			}
			if(ga){
				ga('send', 'event', $('#text').val(), 'GUID', data.questionGuid);
			}
		}
	});
	if(ga){
		ga('send', 'pageview', window.location.hash);	
	}
}