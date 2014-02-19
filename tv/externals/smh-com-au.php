<?php

//require the wordpress codex
require( '../wp-load.php' );

$urls = array(
array("url"=>"http://www.smh.com.au/tv/browse/json_recently/0","type"=>"tv")
);

foreach ($urls as $url) {
	updatenews($url["url"],$url["type"]);
}

function updatenews($url,$type) {
	
	//look for the category by slug	
	$idObj = get_category_by_slug('smh');
	
	// Get the json from the URL
	$jsonp = file_get_contents($url);
	// Remove the container function to create json
	$json = trim($jsonp);
	// Parse the json
	$data = json_decode($json);
	// look for the results withint the json
	$results = $data->item;
	foreach (array_reverse($results) as $result) {
		
		//Get link and preview image
		$link = '<h2><a href="http://www.smh.com.au/tv/'.$result->encodeTitle.'">view</a></h2>';
		$img = '<p><a href="http://www.smh.com.au/tv/'.$result->encodeTitle.'"><img src="'.$result->thumbnail.'"/></a></p>';
		
		// Create post object from json
		$my_post = array(
		  'post_title'    => $result->title,
		  'post_content'  => $img.'<p>'.$result->description.'</p>'.$link,
		  'post_name'     => sanitize_title($result->title),
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_category' => array($idObj->term_id),
		  'tags_input'	  => $type
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
			//log('ID on the first post found '.$my_posts[0]->ID);
		} else {
			// Else, insert the post into the database
			wp_insert_post($my_post);
		}
	}

}

?>