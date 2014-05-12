<?php
class headerbannerrotator extends WP_Widget {
	public function __construct() {
		$widget_ops = array('classname' => 'headerbannerrotator', 'description' => 'Webflow generated widget.' );
		$this->WP_Widget('headerbannerrotator', 'headerbannerrotator', $widget_ops);
	}
	public function widget( $args, $instance ) {
		$ss_uri = get_stylesheet_directory_uri();
?>
<div class="w-container banner-container wp-widget" id="header-banner-rotator">
      <div class="banner-item wp-widget-bg-image" data-ix="banner-rotation">
        <img class="banner-image" src="&lt;?php%20echo%20$hello;%20?&gt;" alt="535b521103baee4253000112_reson3.png" data-ix="banner-rotation"><h2 class="banner-heading wp-widget-editable" data-ix="banner-rotation"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-0"] );?></h2>
        <p class="banner-copy wp-widget-editable" data-ix="banner-rotation"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-1"] );?></p>
      </div>
      <div class="banner-item-two" data-ix="banner-rotation-2">
        <img class="banner-image" src="&lt;?php%20echo%20$hello;%20?&gt;" alt="535b521103baee4253000112_reson3.png" data-ix="banner-rotation"><h2 class="banner-heading wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-2"] );?></h2>
        <p class="banner-copy wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-3"] );?></p>
      </div>
    </div>
<?php
	}
public function form( $instance ) {if ( isset( $instance[ 'wp-widget-editable-0' ] ) ) {
	$title = $instance[ 'wp-widget-editable-0' ];
}
else {
	$title = __( 'Banner Heading', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-0' ); ?>"><?php _e( 'Widget Editable: 0' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-0' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-0' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-1' ] ) ) {
	$title = $instance[ 'wp-widget-editable-1' ];
}
else {
	$title = __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus
          id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-1' ); ?>"><?php _e( 'Widget Editable: 1' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-1' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-1' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-2' ] ) ) {
	$title = $instance[ 'wp-widget-editable-2' ];
}
else {
	$title = __( 'Banner Heading', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-2' ); ?>"><?php _e( 'Widget Editable: 2' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-2' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-2' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-3' ] ) ) {
	$title = $instance[ 'wp-widget-editable-3' ];
}
else {
	$title = __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare, eros dolor interdum nulla, ut commodo diam libero vitae erat. Aenean faucibus nibh et justo cursus
          id rutrum lorem imperdiet. Nunc ut sem vitae risus tristique posuere.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-3' ); ?>"><?php _e( 'Widget Editable: 3' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-3' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-3' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php }
public function update( $new_instance, $old_instance ) {$instance = array();$instance['wp-widget-editable-0'] = ( ! empty( $new_instance['wp-widget-editable-0'] ) ) ? strip_tags( $new_instance['wp-widget-editable-0'] ) : '';$instance['wp-widget-editable-1'] = ( ! empty( $new_instance['wp-widget-editable-1'] ) ) ? strip_tags( $new_instance['wp-widget-editable-1'] ) : '';$instance['wp-widget-editable-2'] = ( ! empty( $new_instance['wp-widget-editable-2'] ) ) ? strip_tags( $new_instance['wp-widget-editable-2'] ) : '';$instance['wp-widget-editable-3'] = ( ! empty( $new_instance['wp-widget-editable-3'] ) ) ? strip_tags( $new_instance['wp-widget-editable-3'] ) : '';return $instance;}
}
add_action( 'widgets_init', function(){
     register_widget( 'headerbannerrotator' );
});
?><?php
function headerbanner() {
	/* Register a dynamic sidebar. */
	register_sidebar(
		array(
			'id' => 'header-banner',
			'name' => __( 'header-banner' ),
			'description' => __( 'header-banner' ),
		)
	);
}
add_action('widgets_init','headerbanner');
?>