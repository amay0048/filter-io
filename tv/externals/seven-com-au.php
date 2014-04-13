<?php

//require the wordpress codex
require( '../wp-load.php' );
require('./featured-image.php');

$urls = array(
array("url"=>"http://au.news.yahoo.com/data/video/archive-mp/aunews_seven_news/2/","type"=>"news"),
array("url"=>"http://au.news.yahoo.com/data/video/archive-mp/aunews_seven_news/1/","type"=>"news")
);

foreach ($urls as $url) {
	updatenews($url["url"],$url["type"]);
}

function updatenews($url,$type) {
	
	$idObj = get_category_by_slug('seven');
	
	// Get the json from the URL
	$html = file_get_contents($url);
	// Parse the json
	$doc = DOMDocument::loadHTML($html);
	$results = $doc->getElementsByTagName('li');

	// look for the results withint the html snip
	foreach ($results as $result) {
		$node = $result->getElementsByTagName('a')->item(0);
		
		if(!is_null($node)){
			
			$href = 'http://au.news.yahoo.com'.$node->getAttribute('href');
			$src = $node->getElementsByTagName('img')->item(0)->getAttribute('src');
			
			$title = $result->getElementsByTagName('a')->item(1)->nodeValue;
			$description = $result->getElementsByTagName('p')->item(0)->nodeValue;
			
			$content = '<p><a href="'.$href.'"><img src="'.$src.'"/></a></p>';
			$content .= '<p>'.$description.'</p>';
			$content .= '<h2><a href="'.$href.'">view</a></h2>';
			
			// Create post object from json
			$my_post = array(
			  'post_title'    => $title,
			  'post_content'  => $content,
			  'post_name'     => sanitize_title($title),
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  'post_category' => array($idObj->term_id),
			  'tags_input'	  => $type
			);
			
			// Create lookup params to see if the post exists
			$args = array(
			  'name' => sanitize_title($title),
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
				$postid = wp_insert_post($my_post);
				featured_image($postid,$src);
			}
		}//endif
	}

}

?>