<?php

//require the wordpress codex
require( '../wp-load.php' );

$urls = array(
"http://www.news.com.au/remote/jsonp-proxy.esi?format=json&includeRelated=true&includeBodies=false&pageSize=20&offset=0&api_key=c38u6s4wrgterpd5kjxvzccu&type=collection&maxRelated=10&category=/video/news.com.au/collection/popular-content/all/24hours&url=http://mashery.news.com.au/content/v1/&callback=_", //popular
"http://www.news.com.au/remote/jsonp-proxy.esi?format=json&includeRelated=true&includeBodies=false&pageSize=14&offset=0&api_key=c38u6s4wrgterpd5kjxvzccu&type=video&category=/video/video.news.com.au/news&url=http://mashery.news.com.au/content/v1/&callback=_",
"http://www.news.com.au/remote/jsonp-proxy.esi?format=json&includeRelated=true&includeBodies=false&pageSize=14&offset=0&api_key=c38u6s4wrgterpd5kjxvzccu&type=video&category=/video/video.news.com.au/news/meet%20the%20press&url=http://mashery.news.com.au/content/v1/&callback=_",
"http://www.news.com.au/remote/jsonp-proxy.esi?format=json&includeRelated=true&includeBodies=false&pageSize=14&offset=0&api_key=c38u6s4wrgterpd5kjxvzccu&type=video&category=/video/video.news.com.au/news/world&url=http://mashery.news.com.au/content/v1/&callback=_",
"http://www.news.com.au/remote/jsonp-proxy.esi?format=json&includeRelated=true&includeBodies=false&pageSize=14&offset=0&api_key=c38u6s4wrgterpd5kjxvzccu&type=video&category=/video/video.news.com.au/news/politics&url=http://mashery.news.com.au/content/v1/&callback=_",
"http://www.news.com.au/remote/jsonp-proxy.esi?format=json&includeRelated=true&includeBodies=false&pageSize=14&offset=0&api_key=c38u6s4wrgterpd5kjxvzccu&type=video&category=/video/video.news.com.au/news/nsw&url=http://mashery.news.com.au/content/v1/&callback=_",
"http://www.news.com.au/remote/jsonp-proxy.esi?format=json&includeRelated=true&includeBodies=false&pageSize=14&offset=0&api_key=c38u6s4wrgterpd5kjxvzccu&type=video&category=/video/video.news.com.au/news/vic&url=http://mashery.news.com.au/content/v1/&callback=_",
"http://www.news.com.au/remote/jsonp-proxy.esi?format=json&includeRelated=true&includeBodies=false&pageSize=14&offset=0&api_key=c38u6s4wrgterpd5kjxvzccu&type=video&category=/video/video.news.com.au/news/qld&url=http://mashery.news.com.au/content/v1/&callback=_",
"http://www.news.com.au/remote/jsonp-proxy.esi?format=json&includeRelated=true&includeBodies=false&pageSize=14&offset=0&api_key=c38u6s4wrgterpd5kjxvzccu&type=video&category=/video/video.news.com.au/news/sa&url=http://mashery.news.com.au/content/v1/&callback=_",
"http://www.news.com.au/remote/jsonp-proxy.esi?format=json&includeRelated=true&includeBodies=false&pageSize=14&offset=0&api_key=c38u6s4wrgterpd5kjxvzccu&type=video&category=/video/video.news.com.au/news/wa&url=http://mashery.news.com.au/content/v1/&callback=_",
"http://www.news.com.au/remote/jsonp-proxy.esi?format=json&includeRelated=true&includeBodies=false&pageSize=14&offset=0&api_key=c38u6s4wrgterpd5kjxvzccu&type=video&category=/video/video.news.com.au/news/tasmania&url=http://mashery.news.com.au/content/v1/&callback=_"
);

//look for the category by slug	
$idObj = get_category_by_slug('news-com-au');

foreach ($urls as $url) {
	updatenews($url);
}

echo 'SUCCESS';

function updatenews($url) {
	
	// Get the json from the URL
	$jsonp = file_get_contents($url);
	// Remove the container function to create json
	$json = substr(trim($jsonp),2,-2);
	// Parse the json
	$data = json_decode($json);
	// look for the results withint the json
	$results = $data->results;
	foreach (array_reverse($results) as $result) {
		
		//echo '<div>';
		//echo '<h2><a href="http://www.news.com.au/video/news/id-'.$result->ooyalaId.'">'.$result->title.'</a></h2>';
		//echo '<p><a href="http://www.news.com.au/video/news/id-'.$result->ooyalaId.'">'.$result->description.'</a></p>';
		//echo '</div>';
		$link = '<h2><a href="http://www.news.com.au/video/news/id-'.$result->ooyalaId.'">view</a></h2>';
		
		// Create post object from json
		$my_post = array(
		  'post_title'    => $result->title,
		  'post_content'  => '<p>'.$result->description.'</p>'.$link,
		  'post_name'     => sanitize_title($result->title),
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_category' => array($idObj->term_id)
		);
		
		// Create lookup params to see if the post exists
		$args = array(
		  'name' => sanitize_title($result->title),
		  'post_type' => 'post',
		  'post_status' => 'any',
		  'numberposts' => 1
		);
		
		$my_posts = get_posts($args);
		
		// If we find a post with this slug, don't create it
		if( $my_posts ) {
			log('ID on the first post found '.$my_posts[0]->ID);
		} else {
			// Else, insert the post into the database
			wp_insert_post($my_post);
		}
	}

}

?>