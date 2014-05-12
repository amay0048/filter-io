<?php

function featured_image($postid,$src){
	
	// And add an image thubnail attachment
	$image = file_get_contents($src);
	$filename = end(explode('/',$src));
	
	$attachment = wp_upload_bits( $filename, null, $image, date("Y-m",time()));
	if( !empty( $attachment['error'] ) )
		$attachment = wp_upload_bits( $filename.'.jpg', null, $image, date("Y-m",time()));
	// TODO: The correct way to do this would be to check the mime type 
	// in a header request, and then create the correct extension. I'll 
	// come back and revisit this
	if( !empty( $attachment['error'] ) )
		return false;
		
	$filetype = wp_check_filetype( basename( $attachment['file'] ), null );
	$postinfo = array(
		'post_mime_type'	=> $filetype['type'],
		'post_title'		=> $my_post->post_title . ' thumbnail',
		'post_content'	=> '',
		'post_status'	=> 'inherit',
	);
	$filename = $attachment['file'];
	$attach_id = wp_insert_attachment( $postinfo, $filename, $postid );
	$bar = add_post_meta($postid, '_thumbnail_id', $attach_id, true);
	
	if( !function_exists( 'wp_generate_attachment_data' ) )
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		
	$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	wp_update_attachment_metadata( $attach_id,  $attach_data );
}

?>