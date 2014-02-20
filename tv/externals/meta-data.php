<?php
/**
 * This function requires a custom type of "Show/s" to have been
 * created in wordpress. This function will query by slug and return
 * the post ID for the show if it already exists. If not, it will
 * run a query against trakt, and iTunes to create a show and 
 * pre-populate this with meta-data, then return the newly created 
 * show ID
 **/

// We need the wordpress codex as we will be looking up show data
require( '../wp-load.php' );
// Abstract this into a function so that we can reuse it
function get_meta_data($show,$idObj){
	$keywords = urlencode($show);
	$trakturl = "http://api.trakt.tv/search/shows.json/f4980e1fa96b6e330e1ca87430a33160?query=$keywords";
	// Create a lookup array, the custom type has been previously 
	// created using the types plugin
	$args = array(
	  //'name' => sanitize_title($show),
	  'name' => sanitize_title($show),
	  'post_type' => 'show',
	  'post_status' => 'any',
	  'numberposts' => 1
	);
	// Run the wordpress query
	$my_posts = get_posts($args);
	// If we find a show with the correct slug, return it
	if($my_posts){
		return $my_posts[0]->ID;
	// Else we will do some lookups to create a new show
	} else {
		$data = file_get_contents($trakturl);
		$json = json_decode($data);
		$result = $json[0];
		if($result){
			// Now we have the meta, first thing to do is create a new show
			$my_post = array(
			  'post_title'    => $result->title,
			  'post_content'  => '<p>'.$result->overview.'</p>',
			  'post_name'     => sanitize_title($show),
			  'post_type' => 'show',
			  'post_status'   => 'publish',
			  'post_author'   => 1,
			  //'post_category' => array($idObj->term_id),
			  'tags_input'	  => $result->genres
			);
			$post_id = wp_insert_post($my_post);
			// Now we have a show ID, we can update the meta tags
			update_post_meta($post_id, 'wpcf-year', $result->year);
			update_post_meta($post_id, 'wpcf-country', $result->country);
			update_post_meta($post_id, 'wpcf-overview', $result->overview);
			update_post_meta($post_id, 'wpcf-runtime', $result->runtime);
			update_post_meta($post_id, 'wpcf-network', $result->network);
			update_post_meta($post_id, 'wpcf-rating', $result->certification);
			update_post_meta($post_id, 'wpcf-poster', $result->images->poster);
			update_post_meta($post_id, 'wpcf-fanart', $result->images->fanart);
			update_post_meta($post_id, 'wpcf-banner', $result->images->banner);
			update_post_meta($post_id, 'wpcf-percentage', $result->ratings->percentage);
			update_post_meta($post_id, 'wpcf-votes', $result->ratings->votes);
			$facebook = get_facebook_link($show);
			update_post_meta($post_id, 'wpcf-facebook-page', $facebook);
			$twitter = get_twitter_link($show);
			update_post_meta($post_id, 'wpcf-twitter-account', $twitter);
			$itunes = get_itunes_link($show);
			update_post_meta($post_id, 'wpcf-itunes-collection', $itunes);
			$youtube = get_youtube_link($show);
			update_post_meta($post_id, 'wpcf-youtube-channel', $youtube);
			
			return $post_id;
		} else {
			return NULL;
		}
	}
	
}

function get_facebook_link($show){
	$keywords = urlencode($show);
	$searchurl = "https://www.google.com.au/search?safe=off&output=search&sclient=psy-ab&q=facebook+$keywords";
	$html = file_get_contents($searchurl);
	// Parse the HTML
	$doc = DOMDocument::loadHTML($html);
	// Grab the parent container
	$container = $doc->getElementById('search');
	$res = $container->getElementsByTagName('cite')->item(0)->nodeValue;
	return $res;
}

function get_twitter_link($show){
	$keywords = urlencode($show);
	$searchurl = "https://www.google.com.au/search?safe=off&output=search&sclient=psy-ab&q=twitter+$keywords";
	$html = file_get_contents($searchurl);
	// Parse the HTML
	$doc = DOMDocument::loadHTML($html);
	// Grab the parent container
	$container = $doc->getElementById('search');
	$res = $container->getElementsByTagName('cite')->item(0)->nodeValue;
	return $res;
}

function get_youtube_link($show){
	$keywords = urlencode($show);
	$searchurl = "https://www.google.com.au/search?safe=off&output=search&sclient=psy-ab&q=youtube+$keywords";
	$html = file_get_contents($searchurl);
	// Parse the HTML
	$doc = DOMDocument::loadHTML($html);
	// Grab the parent container
	$container = $doc->getElementById('search');
	$res = $container->getElementsByTagName('cite')->item(0)->nodeValue;
	return $res;
}

function get_itunes_link($show){
	$keywords = urlencode($show);
	$searchurl = "https://itunes.apple.com/search?country=AU&media=tvShow&entity=tvSeason&term=$keywords";
	$json = file_get_contents($searchurl);
	$result = json_decode($json);
	return $result->results[0]->artistViewUrl;
}

?>