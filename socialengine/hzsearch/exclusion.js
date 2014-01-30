var preventSearchOnTagChange = true;

var linguisticTags = function(string, callback){
	
	//console.log('hello');
	
	var words = new Lexer().lex(string);
	var posTags = new POSTagger().tag(words);
	var ret = [];
			
	for(i in posTags){
		//console.log(posTags[i][0],':',posTags[i][1]);
		
		if(
		/*
			posTags[i][1] == 'ABL' ||
			posTags[i][1] == 'ABN' ||
			posTags[i][1] == 'ABX' ||
			posTags[i][1] == 'AP' ||
			posTags[i][1] == 'AP$' ||
			posTags[i][1] == 'AP+AP' ||
		*/
			posTags[i][1] == 'AT' ||
			//posTags[i][1] == 'BE' ||
			posTags[i][1] == 'BED' ||
			posTags[i][1] == 'BED*' ||
			posTags[i][1] == 'BEDZ' ||
			posTags[i][1] == 'BEDZ*' ||
			posTags[i][1] == 'BEG' ||
			posTags[i][1] == 'BEM' ||
			posTags[i][1] == 'BEM*' ||
			posTags[i][1] == 'BEN' ||
			posTags[i][1] == 'BER' ||
			posTags[i][1] == 'BER*' ||
			posTags[i][1] == 'BEZ' ||
			posTags[i][1] == 'BEZ*' ||
			posTags[i][1] == 'CC' ||
		/*
			posTags[i][1] == 'CD' ||
			posTags[i][1] == 'CD$' ||
		*/
			posTags[i][1] == 'CS' ||
			posTags[i][1] == 'DO' ||
			//posTags[i][1] == 'DO*' ||
			posTags[i][1] == 'DO+PPSS' ||
			posTags[i][1] == 'DOD' ||
			//posTags[i][1] == 'DOD*' ||
			posTags[i][1] == 'DOZ' ||
			//posTags[i][1] == 'DOZ*' ||
			posTags[i][1] == 'DT' ||
			posTags[i][1] == 'DT$' ||
			posTags[i][1] == 'DT+BEZ' ||
			posTags[i][1] == 'DT+MD' ||
			posTags[i][1] == 'DTI' ||
			posTags[i][1] == 'DTS' ||
			posTags[i][1] == 'DTS+BEZ' ||
			posTags[i][1] == 'DTX' ||
		/*
			posTags[i][1] == 'EX' ||
			posTags[i][1] == 'EX+BEZ' ||
			posTags[i][1] == 'EX+HVD' ||
			posTags[i][1] == 'EX+HVZ' ||
			posTags[i][1] == 'EX+MD' ||
			posTags[i][1] == 'FW-*' ||
			posTags[i][1] == 'FW-AT' ||
			posTags[i][1] == 'FW-AT+NN' ||
			posTags[i][1] == 'FW-AT+NP' ||
			posTags[i][1] == 'FW-BE' ||
			posTags[i][1] == 'FW-BER' ||
			posTags[i][1] == 'FW-BEZ' ||
			posTags[i][1] == 'FW-CC' ||
			posTags[i][1] == 'FW-CD' ||
			posTags[i][1] == 'FW-CS' ||
			posTags[i][1] == 'FW-DT' ||
			posTags[i][1] == 'FW-DT+BEZ' ||
			posTags[i][1] == 'FW-DTS' ||
			posTags[i][1] == 'FW-HV' ||
			posTags[i][1] == 'FW-IN' ||
			posTags[i][1] == 'FW-IN+AT' ||
			posTags[i][1] == 'FW-IN+NN' ||
			posTags[i][1] == 'FW-IN+NP' ||
			posTags[i][1] == 'FW-JJ' ||
			posTags[i][1] == 'FW-JJR' ||
			posTags[i][1] == 'FW-JJT' ||
			posTags[i][1] == 'FW-NN' ||
			posTags[i][1] == 'FW-NN$' ||
			posTags[i][1] == 'FW-NNS' ||
			posTags[i][1] == 'FW-NP' ||
			posTags[i][1] == 'FW-NPS' ||
			posTags[i][1] == 'FW-NR' ||
			posTags[i][1] == 'FW-OD' ||
			posTags[i][1] == 'FW-PN' ||
			posTags[i][1] == 'FW-PP$' ||
			posTags[i][1] == 'FW-PPL' ||
			posTags[i][1] == 'FW-PPL+VBZ' ||
			posTags[i][1] == 'FW-PPO' ||
			posTags[i][1] == 'FW-PPO+IN' ||
			posTags[i][1] == 'FW-PPS' ||
			posTags[i][1] == 'FW-PPSS' ||
			posTags[i][1] == 'FW-PPSS+HV' ||
			posTags[i][1] == 'FW-QL' ||
			posTags[i][1] == 'FW-RB' ||
			posTags[i][1] == 'FW-RB+CC' ||
			posTags[i][1] == 'FW-TO+VB' ||
			posTags[i][1] == 'FW-UH' ||
			posTags[i][1] == 'FW-VB' ||
			posTags[i][1] == 'FW-VBD' ||
			posTags[i][1] == 'FW-VBG' ||
			posTags[i][1] == 'FW-VBN' ||
			posTags[i][1] == 'FW-VBZ' ||
			posTags[i][1] == 'FW-WDT' ||
			posTags[i][1] == 'FW-WPO' ||
			posTags[i][1] == 'FW-WPS' ||
			posTags[i][1] == 'HV' ||
			posTags[i][1] == 'HV*' ||
			posTags[i][1] == 'HV+TO' ||
			posTags[i][1] == 'HVD' ||
			posTags[i][1] == 'HVD*' ||
			posTags[i][1] == 'HVG' ||
			posTags[i][1] == 'HVN' ||
			posTags[i][1] == 'HVZ' ||
			posTags[i][1] == 'HVZ*' ||
		*/
			posTags[i][1] == 'IN' ||
			posTags[i][1] == 'IN+IN' ||
			posTags[i][1] == 'IN+PPO' ||
		/*
			posTags[i][1] == 'JJ' ||
			posTags[i][1] == 'JJ$' ||
			posTags[i][1] == 'JJ+JJ' ||
			posTags[i][1] == 'JJR' ||
			posTags[i][1] == 'JJR+CS' ||
			posTags[i][1] == 'JJS' ||
			posTags[i][1] == 'JJT' ||
		*/
			posTags[i][1] == 'MD' ||
			posTags[i][1] == 'MD*' ||
			posTags[i][1] == 'MD+HV' ||
			posTags[i][1] == 'MD+PPSS' ||
			posTags[i][1] == 'MD+TO' ||
		/*
			posTags[i][1] == 'NN' ||
			posTags[i][1] == 'NN$' ||
			posTags[i][1] == 'NN+BEZ' ||
			posTags[i][1] == 'NN+HVD' ||
			posTags[i][1] == 'NN+HVZ' ||
			posTags[i][1] == 'NN+IN' ||
			posTags[i][1] == 'NN+MD' ||
			posTags[i][1] == 'NN+NN' ||
			posTags[i][1] == 'NNS' ||
			posTags[i][1] == 'NNS$' ||
			posTags[i][1] == 'NNS+MD' ||
			posTags[i][1] == 'NP' ||
			posTags[i][1] == 'NP$' ||
			posTags[i][1] == 'NP+BEZ' ||
			posTags[i][1] == 'NP+HVZ' ||
			posTags[i][1] == 'NP+MD' ||
			posTags[i][1] == 'NPS' ||
			posTags[i][1] == 'NPS$' ||
			posTags[i][1] == 'NR' ||
			posTags[i][1] == 'NR$' ||
			posTags[i][1] == 'NR+MD' ||
			posTags[i][1] == 'NRS' ||
			posTags[i][1] == 'OD' ||
		*/
			posTags[i][1] == 'PN' ||
			posTags[i][1] == 'PN$' ||
			posTags[i][1] == 'PN+BEZ' ||
			posTags[i][1] == 'PN+HVD' ||
			posTags[i][1] == 'PN+HVZ' ||
			posTags[i][1] == 'PN+MD' ||
			posTags[i][1] == 'PP$' ||
			posTags[i][1] == 'PP$$' ||
			posTags[i][1] == 'PRP$' ||
			posTags[i][1] == 'PPL' ||
			posTags[i][1] == 'PPLS' ||
			//posTags[i][1] == 'PPO' ||
			posTags[i][1] == 'PPS' ||
			posTags[i][1] == 'PPS+BEZ' ||
			posTags[i][1] == 'PPS+HVD' ||
			posTags[i][1] == 'PPS+HVZ' ||
			posTags[i][1] == 'PPS+MD' ||
			posTags[i][1] == 'PPSS' ||
			posTags[i][1] == 'PPSS+BEM' ||
			posTags[i][1] == 'PPSS+BER' ||
			posTags[i][1] == 'PPSS+BEZ' ||
			posTags[i][1] == 'PPSS+BEZ*' ||
			posTags[i][1] == 'PPSS+HV' ||
			posTags[i][1] == 'PPSS+HVD' ||
			posTags[i][1] == 'PPSS+MD' ||
			posTags[i][1] == 'PPSS+VB' ||
		/*
			posTags[i][1] == 'QL' ||
			posTags[i][1] == 'QLP' ||
			posTags[i][1] == 'RB' ||
			posTags[i][1] == 'RB$' ||
			posTags[i][1] == 'RB+BEZ' ||
			posTags[i][1] == 'RB+CS' ||
			posTags[i][1] == 'RBR' ||
			posTags[i][1] == 'RBR+CS' ||
			posTags[i][1] == 'RBT' ||
			posTags[i][1] == 'RN' ||
			posTags[i][1] == 'RP' ||
			posTags[i][1] == 'RP+IN' ||
		*/
			posTags[i][1] == 'TO' ||
			posTags[i][1] == 'TO+VB' ||
		/*
			posTags[i][1] == 'UH' ||
			posTags[i][1] == 'VB' ||
			posTags[i][1] == 'VB+AT' ||
			posTags[i][1] == 'VB+IN' ||
			posTags[i][1] == 'VB+JJ' ||
			posTags[i][1] == 'VB+PPO' ||
			posTags[i][1] == 'VB+RP' ||
			posTags[i][1] == 'VB+TO' ||
			posTags[i][1] == 'VB+VB' ||
			posTags[i][1] == 'VBD' ||
			posTags[i][1] == 'VBG' ||
			posTags[i][1] == 'VBG+TO' ||
			posTags[i][1] == 'VBN' ||
			posTags[i][1] == 'VBN+TO' ||
			posTags[i][1] == 'VBZ' ||
		*/
			posTags[i][1] == 'WDT' ||
			posTags[i][1] == 'WDT+BER' ||
			posTags[i][1] == 'WDT+BER+PP' ||
			posTags[i][1] == 'WDT+BEZ' ||
			posTags[i][1] == 'WDT+DO+PPS' ||
			posTags[i][1] == 'WDT+DOD' ||
			posTags[i][1] == 'WDT+HVZ' ||
			posTags[i][1] == 'WP' ||
			posTags[i][1] == 'WP|IN' ||
			posTags[i][1] == 'WP$' ||
			posTags[i][1] == 'WPO' ||
			posTags[i][1] == 'WPS' ||
			posTags[i][1] == 'WPS+BEZ' ||
			posTags[i][1] == 'WPS+HVD' ||
			posTags[i][1] == 'WPS+HVZ' ||
			posTags[i][1] == 'WPS+MD' ||
			posTags[i][1] == 'WQL' ||
			posTags[i][1] == 'WRB' ||
			posTags[i][1] == 'WRB+BER' ||
			posTags[i][1] == 'WRB+BEZ' ||
			posTags[i][1] == 'WRB+DO' ||
			posTags[i][1] == 'WRB+DOD' ||
			posTags[i][1] == 'WRB+DOD*' ||
			posTags[i][1] == 'WRB+DOZ' ||
			posTags[i][1] == 'WRB+IN' ||
			posTags[i][1] == 'WRB+MD' || /* */
			posTags[i][1] == 'BE'
		){
		
		} else {
			ret.push(posTags[i][0]);
		}
	}
	
	callback(ret,string);
}

var updateTags = function(tagArray){
	for (i in tagArray){
		searchTags.push(tagArray[i]);
	}
	hzSearch();
	posTagsSearch();
}

var posTagsSearch = function(){

	var url = 'https://www.googleapis.com/customsearch/v1?key=AIzaSyCMGfdDaSfjqv5zYoS0mTJnOT3e9MURWkU&cx=008033386019488104181:r3ynnevaasg&googlehost=google.com.au&filter=1&q=' + searchTags.toString().replace(/,/g , "%20");
	$.ajax({
	'url': url,
	'success': function(data, textStats, XMLHttpRequest) {
		var output = '';
		var displayLink = '';
		var searchResults = {};
		var ret = [];
		console.log(data);

			for(i in data['items']){
				displayLink = data['items'][i]['displayLink'];
				searchResults[displayLink];
				
				if (isNaN(searchResults[displayLink])){
					searchResults[displayLink] = 1;
				} else {
					searchResults[displayLink]++;
				}

				if(i < 8 && searchResults[displayLink] <= 2) {
				 output = output + '<h3>' + data['items'][i]['htmlTitle'] + '</h3>';
				 output = output + '<p>' + data['items'][i]['snippet'] + '&nbsp;&nbsp;';
				 output = output + '<a href="' + data['items'][i]['link'] + '">Read more...</a>' + '</p>';
				 ret.push([data['items'][i]['title'],data['items'][i]['link'],i]);
				} else {
				  break;
				}

			}
			$("#results").html(output);
			$('#title').val($('#searchText').val());
			$('#description').val(output);
			/*
			if(ga) {
				var date = new Date();
				ga('send', 'event', $('#text').val(), $('#tags').val(), ret.toString(),Number(date.getTime()));
				ga('send', 'event', $('#text').val(), 'providers', providers.toString());
			}
			*/
			preventSearchOnTagChange = false;
		}
	});
}
/*
$(function(){
	$('#tags_1').tagsInput({
		width:'auto',
		defaultText:'add or remove a keyword',
		onChange:function(){
			if(preventSearchOnTagChange == false){
				posTagsSearch();
			}
		},
		height:'40px'
	});
});
*/