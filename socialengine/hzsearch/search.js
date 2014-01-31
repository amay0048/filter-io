var hash = window.location.hash;

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

var hzSearch = function(text){
	$.get("https://bombur-us-east-1.searchly.com/api-key/bhnpketpvhfzjqgt3zhlrficenee25zw/wordpress_staging/_search?q=_all:" + searchTags.toString().replace(/,/g , "%20"), function( data ) {
		var results = data['hits']['hits'];
		var snapshot = false;
		$('#providersResult').html('');
		$('#snapshotResult').html('');
		for(i in results){
			result = results[i]['_source'];
			if(result.cats.indexOf('snapshots') > -1 && !snapshot){
				snapshot = true;
				console.log('snapshot',result);
				html = '<h3>'+result.title+'</h3>' + result.content;
				$('#snapshotResult').html(html);
			} else if(result.cats.indexOf('providers') > -1){
				console.log('provider',result);
				html = result.content + '<h3>'+result.title+'</h3>';
				$('#providersResult').append(html);
			}
		}
		$('#snapshot').val($('#snapshotResult').html());
		$('#providers').val($('#providersResult').html());
	});
}