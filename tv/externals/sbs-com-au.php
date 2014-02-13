<?php

//require the wordpress codex
require( '../wp-load.php' );

$urls = array(
"http://www.sbs.com.au/api/video_feed/f/Bgtm9B/sbs-section-sbstv?form=json&byCategories=News+and+Current+Affairs%7CSport%7CSpecial+Events%2CSection%2FClips%7CSection%2FPrograms&range=21-40",
"http://www.sbs.com.au/api/video_feed/f/Bgtm9B/sbs-section-sbstv?form=json&byCategories=News+and+Current+Affairs%7CSport%7CSpecial+Events%2CSection%2FClips%7CSection%2FPrograms&range=1-20"
);

foreach ($urls as $url) {
	updatenews($url);
}

function updatenews($url) {

	// Get the json from the URL
	$json = file_get_contents($url);
	// Parse the json
	$data = json_decode($json);

	// look for the results withint the json
	$results = $data->entries;
	foreach (array_reverse($results) as $result) {
		
		$videoId = array_pop(explode('/',$result->id));
		$link = '<h2><a href="http://www.sbs.com.au/ondemand/video/'.$videoId.'">view</a></h2>';

		// Create post object from json
		$my_post = array(
		  'post_title'    => $result->title,
		  'post_content'  => '<p>'.$result->description.'</p>'.$link,
		  'post_name'     => sanitize_title($result->title),
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_category' => array(9)
		);
		
		// Create lookup params to see if the post exists
		$args = array(
		  'name' => sanitize_title($result->title),
		  'post_type' => 'post',
		  'post_status' => 'publish',
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