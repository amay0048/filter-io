<?php

//require the wordpress codex
require( '../wp-load.php' );

$urls = array(
"http://www.abc.net.au/news/feed/54768/rss.xml"
);

//look for the category by slug	
$idObj = get_category_by_slug('abc-com-au');

foreach ($urls as $url) {
	updatenews($url);
}

function updatenews($url) {

	// Get the json from the URL
	$data = simplexml_load_file($url);

	// look for the results withint the json
	$results = $data->channel->item;
	foreach ($results as $result) {
		
		$link = '<h2><a href="'.$result->link.'">view</a></h2>';
		
		// Create post object from json
		$my_post = array(
		  'post_title'    => $result->title,
		  'post_content'  => $link,
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
			//log('ID on the first post found '.$my_posts[0]->ID);
		} else {
			// Else, insert the post into the database
			wp_insert_post($my_post);
		}
	}

}

?>