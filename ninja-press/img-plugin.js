// JavaScript Document

/**
  <div class="image_uploader">
	<input id="upload_image_1" class="upload_text" type="text" size="36" name="ad_image" value="http://" /> 
	<input id="upload_image_button_1" class="upload_button" type="button" value="Upload Image" />
	<label for="upload_image_1">Enter a URL or upload an image</label>
  </div>
 **/

jQuery.fn.extend({
  wp_uploader: function() {
    return this.each(function() {
		var $target_text = this.find(".upload_text");
		var $target_btn = this.find(".upload_button");
		
		$target_btn.click(function(e) {
 
			e.preventDefault();
	 
			//If the uploader object has already been created, reopen the dialog
			if (custom_uploader) {
				custom_uploader.open();
				return;
			}
	 
			//Extend the wp.media object
			custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Choose Image',
				button: {
					text: 'Choose Image'
				},
				multiple: false
			});
	 
			//When a file is selected, grab the URL and set it as the text field's value
			custom_uploader.on('select', function() {
				attachment = custom_uploader.state().get('selection').first().toJSON();
				$target_text.val(attachment.url);
			});
	 
			//Open the uploader dialog
			custom_uploader.open();
		});

    });
  }
});