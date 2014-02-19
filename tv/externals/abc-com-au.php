<?php

//require the wordpress codex
require( '../wp-load.php' );

$urls = array(
//array("url"=>"http://www.abc.net.au/news/feed/54768/rss.xml", "type"=>"news"),//NEWS
array("url"=>"http://tviview.abc.net.au/iview/rss/recent.xml", "type"=>"tv")//TV
);

foreach ($urls as $url) {
	updatenews($url["url"],$url["type"]);
}

function updatenews($url,$type) {
	//look for the category by slug	
	$idObj = get_category_by_slug('abc');

	// Get the json from the URL
	$data = file_get_contents($url);

	$dom = DOMDocument::loadXML($data);

	// look for the results withint the json
	$results = $dom->getElementsByTagName('item');
	
	foreach ($results as $result) {
		
		$src = $result->getElementsByTagName('thumbnail')->item(0)->getAttribute('url');
		$title = $result->getElementsByTagName('title')->item(0)->nodeValue;
		$href = $result->getElementsByTagName('link')->item(0)->nodeValue;
		$categoryNodes = $result->getElementsByTagName('category');
		$categories = array();
		$categories[] = $type;
		foreach($categoryNodes as $categoryNode){
			$categories[] = $categoryNode->nodeValue;
		}
				
		$content = '<p><a href="'.$href.'"><img src="'.$src.'"/></a></p><h2><a href="'.$href.'">view</a></h2>';
		
		// Create post object from json
		$my_post = array(
		  'post_title'    => $title,
		  'post_content'  => $content,
		  'post_name'     => sanitize_title($title),
		  'post_status'   => 'publish',
		  'post_author'   => 1,
		  'post_category' => array($idObj->term_id),
		  'tags_input'	  => $categories
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
			wp_insert_post($my_post);
		}
	}

}

?>