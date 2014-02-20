<?php

//require the wordpress codex
require( '../wp-load.php' );
require( './meta-data.php' );

$urls = array(
array("url"=>"http://www.sbs.com.au/api/video_feed/f/Bgtm9B/sbs-section-sbstv?form=json&byCategories=News+and+Current+Affairs%7CSport%7CSpecial+Events%2CSection%2FClips%7CSection%2FPrograms&range=21-40","type"=>"news"),//NEWS
array("url"=>"http://www.sbs.com.au/api/video_feed/f/Bgtm9B/sbs-section-sbstv?form=json&byCategories=News+and+Current+Affairs%7CSport%7CSpecial+Events%2CSection%2FClips%7CSection%2FPrograms&range=1-20","type"=>"news"),//NEWS
array("url"=>"http://www.sbs.com.au/api/video_feed/f/Bgtm9B/sbs-section-sbstv?form=json&byCategories=Arts%7CDrama%7CEducation%7CFactual%7CFood%7COpera%7CComedy%7CDocumentary%2CSection%2FClips%7CSection%2FPrograms&range=1-20","type"=>"tv"),//TV 
array("url"=>"http://www.sbs.com.au/api/video_feed/f/Bgtm9B/sbs-section-sbstv?form=json&byCategories=Arts%7CDrama%7CEducation%7CFactual%7CFood%7COpera%7CComedy%7CDocumentary%2CSection%2FClips%7CSection%2FPrograms&range=21-40","type"=>"tv")//TV 
);

foreach ($urls as $url) {
	updatenews($url["url"],$url["type"]);
}

function updatenews($url,$type) {
	//look for the category by slug	
	$idObj = get_category_by_slug('sbs');
	
	// Get the json from the URL
	$json = file_get_contents($url);
	// Parse the json
	$data = json_decode($json);

	// look for the results withint the json
	$results = $data->entries;
	
	foreach (array_reverse($results) as $result) {
		$categories = array();
		$categories[] = $type;
		
		$aResult = (array)$result;
		$aThumb = (array)$aResult['media$thumbnails'][1];
		$videoId = array_pop(explode('/',$result->id));
		
		$src = $aThumb['plfile$downloadUrl'];
		$href = 'http://www.sbs.com.au/ondemand/video/'.$videoId;
		
		$show = $aResult['pl1$programName'];
		$categories[] = $show;
		if($type == 'tv'){
			$show_id = get_meta_data($show,$idObj);
		}
		
		$title = $result->title;
		
		foreach($aResult['media$categories'] as $categoryNode){
			$aCategory = (array)$categoryNode;
			if($aCategory['media$scheme'] == 'Genre'){
				$categories[] = $aCategory['media$name'];
			}
		}
		
		$content = '<p><a href="'.$href.'"><img src="'.$src.'"/></a></p>';
		$content .= '<p>'.$result->description.'</p>';
		$content .= '<h2><a href="'.$href.'">view</a></h2>';

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
		if($show_id && $type == 'tv'){
			$my_post['post_parent'] = $show_id;
		}
		
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