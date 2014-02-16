<?php

//require the wordpress codex
require( '../wp-load.php' );

$urls = array(
"http://au.news.yahoo.com/data/video/archive-mp/aunews_seven_news/2/",
"http://au.news.yahoo.com/data/video/archive-mp/aunews_seven_news/1/"
);

foreach ($urls as $url) {
	updatenews($url);
}

function updatenews($url) {

	// Get the json from the URL
	$html = file_get_contents($url);
	// Parse the json
	$doc = DOMDocument::loadHTML($html);
	$results = $doc->getElementsByTagName('li');

	// look for the results withint the json
	foreach ($results as $result) {
		$node = $result->getElementsByTagName('a')->item(1);
		if(!is_null($node)){

			$link = '<h2><a href="http://au.news.yahoo.com'.$node->getAttribute('href').'">view</a></h2>';
			
			// Create post object from json
			$my_post = array(
			  'post_title'    => $node->nodeValue,
			  'post_content'  => $link,
			  'post_name'     => sanitize_title($node->nodeValue),
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  'post_category' => array(8)
			);
			
			// Create lookup params to see if the post exists
			$args = array(
			  'name' => sanitize_title($node->nodeValue),
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
		}//endif
	}

}

?>