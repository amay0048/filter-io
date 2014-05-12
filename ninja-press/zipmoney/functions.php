<?php
class banneremail extends WP_Widget {
	public function __construct() {
		$widget_ops = array('classname' => 'banneremail', 'description' => 'Webflow generated widget.' );
		$this->WP_Widget('banneremail', 'banneremail', $widget_ops);
	}
	public function widget( $args, $instance ) {
		$ss_uri = get_stylesheet_directory_uri();
?>
<div class="w-container wp-widget" id="banner-email">
        <h2>Buy Now, Pay Later</h2>
        <ul>
<li>Quick</li>
          <li>Easy</li>
          <li>Secure</li>
        </ul>
<h3>Online Credit For Your Online Shopping</h3>
        <div class="w-form">
          <form id="email-form" name="email-form" data-name="Email Form">
            <label for="email">Email Address:</label>
            <input class="w-input" id="email" type="email" placeholder="Enter your email address" name="email" data-name="Email" required="required"><input class="w-button" type="submit" value="Get Invited" data-wait="Please wait...">
</form>
          <div class="w-form-done">
            <p>Thank you! Your submission has been received!</p>
          </div>
          <div class="w-form-fail">
            <p>Oops! Something went wrong while submitting the form :(</p>
          </div>
        </div>
      </div>
<?php
	}


}
add_action( 'widgets_init', function(){
     register_widget( 'banneremail' );
});
?><?php
class homepagethreereasons extends WP_Widget {
	public function __construct() {
		$widget_ops = array('classname' => 'homepagethreereasons', 'description' => 'Webflow generated widget.' );
		$this->WP_Widget('homepagethreereasons', 'homepagethreereasons', $widget_ops);
	}
	public function widget( $args, $instance ) {
		$ss_uri = get_stylesheet_directory_uri();
?>
<div class="wp-widget" id="homepage-three-reasons">
      <div class="w-container">
        <h2 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-0"] );?></h2>
        <div class="w-row">
          <div class="w-col w-col-4 w-col-small-4">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/Plane-Icon.png\" alt=\"53575ced723f05e3330001c4_Plane-Icon.png\">";?><h4 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-1"] );?></h4>
            <p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-2"] );?></p>
          </div>
          <div class="w-col w-col-4 w-col-small-4">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/Thumb_icon.png\" alt=\"53575d193769dde233000277_Thumb_icon.png\">";?><h4 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-3"] );?></h4>
            <p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-4"] );?></p>
          </div>
          <div class="w-col w-col-4 w-col-small-4">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/Lock_icon.png\" alt=\"53575d2a3769dde233000278_Lock_icon.png\">";?><h4 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-5"] );?></h4>
            <p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-6"] );?></p>
          </div>
        </div>
      </div>
    </div>
<?php
	}
public function form( $instance ) {if ( isset( $instance[ 'wp-widget-editable-0' ] ) ) {
	$title = $instance[ 'wp-widget-editable-0' ];
}
else {
	$title = __( 'Three great reasons to Shop Online with zipMoney', 'text_domain' );
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
	$title = __( 'Quick', 'text_domain' );
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
	$title = __( 'Online. Real time. Credit now available to finance your shopping cart.', 'text_domain' );
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
	$title = __( 'Easy', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-3' ); ?>"><?php _e( 'Widget Editable: 3' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-3' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-3' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-4' ] ) ) {
	$title = $instance[ 'wp-widget-editable-4' ];
}
else {
	$title = __( 'Goodbye to plastic and long, clunky credit card numbers. Hello &quot;Credit in the Cloud&quot;.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-4' ); ?>"><?php _e( 'Widget Editable: 4' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-4' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-4' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-5' ] ) ) {
	$title = $instance[ 'wp-widget-editable-5' ];
}
else {
	$title = __( 'Secure', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-5' ); ?>"><?php _e( 'Widget Editable: 5' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-5' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-5' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-6' ] ) ) {
	$title = $instance[ 'wp-widget-editable-6' ];
}
else {
	$title = __( 'Shop with confidence. 24/7 fraud protection. Our partners service eBay and Amazon.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-6' ); ?>"><?php _e( 'Widget Editable: 6' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-6' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-6' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php }
public function update( $new_instance, $old_instance ) {$instance = array();$instance['wp-widget-editable-0'] = ( ! empty( $new_instance['wp-widget-editable-0'] ) ) ? strip_tags( $new_instance['wp-widget-editable-0'] ) : '';$instance['wp-widget-editable-1'] = ( ! empty( $new_instance['wp-widget-editable-1'] ) ) ? strip_tags( $new_instance['wp-widget-editable-1'] ) : '';$instance['wp-widget-editable-2'] = ( ! empty( $new_instance['wp-widget-editable-2'] ) ) ? strip_tags( $new_instance['wp-widget-editable-2'] ) : '';$instance['wp-widget-editable-3'] = ( ! empty( $new_instance['wp-widget-editable-3'] ) ) ? strip_tags( $new_instance['wp-widget-editable-3'] ) : '';$instance['wp-widget-editable-4'] = ( ! empty( $new_instance['wp-widget-editable-4'] ) ) ? strip_tags( $new_instance['wp-widget-editable-4'] ) : '';$instance['wp-widget-editable-5'] = ( ! empty( $new_instance['wp-widget-editable-5'] ) ) ? strip_tags( $new_instance['wp-widget-editable-5'] ) : '';$instance['wp-widget-editable-6'] = ( ! empty( $new_instance['wp-widget-editable-6'] ) ) ? strip_tags( $new_instance['wp-widget-editable-6'] ) : '';return $instance;}
}
add_action( 'widgets_init', function(){
     register_widget( 'homepagethreereasons' );
});
?><?php
class homepagehowitworks extends WP_Widget {
	public function __construct() {
		$widget_ops = array('classname' => 'homepagehowitworks', 'description' => 'Webflow generated widget.' );
		$this->WP_Widget('homepagehowitworks', 'homepagehowitworks', $widget_ops);
	}
	public function widget( $args, $instance ) {
		$ss_uri = get_stylesheet_directory_uri();
?>
<div class="wp-widget" id="homepage-how-it-works">
      <div class="w-container">
        <h2 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-0"] );?></h2>
        <div>
          <h3 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-1"] );?></h3>
          <?php echo "<img src=\"$ss_uri/images/reson1.png\" alt=\"53575e59348663c936000272_reson1.png\">";?><p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-2"] );?></p>
        </div>
        <div>
          <h3 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-3"] );?></h3>
          <?php echo "<img src=\"$ss_uri/images/reson2.png\" alt=\"53575ec63769dde23300028a_reson2.png\">";?><p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-4"] );?></p>
        </div>
        <div>
          <h3 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-5"] );?></h3>
          <?php echo "<img src=\"$ss_uri/images/reson3.png\" alt=\"53575f1f3769dde233000296_reson3.png\">";?><p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-6"] );?></p>
        </div>
        <h3 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-7"] );?></h3>
<a class="button btn-center" href="#">Get Involved</a>
      </div>
    </div>
<?php
	}
public function form( $instance ) {if ( isset( $instance[ 'wp-widget-editable-0' ] ) ) {
	$title = $instance[ 'wp-widget-editable-0' ];
}
else {
	$title = __( 'How it works', 'text_domain' );
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
	$title = __( 'Apply easily', 'text_domain' );
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
	$title = __( 'Apply online and get an instant credit decision. Once approved, come back as often as you like. If you need more credit, just ask. Build your score by connecting to social such as Facebook and Twitter.', 'text_domain' );
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
	$title = __( 'Buy Online...', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-3' ); ?>"><?php _e( 'Widget Editable: 3' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-3' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-3' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-4' ] ) ) {
	$title = $instance[ 'wp-widget-editable-4' ];
}
else {
	$title = __( 'Get your goods today before you pay. Simply select zipMoney as the preferred payment method at checkout and enter your email and password to buy securely and instantly.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-4' ); ?>"><?php _e( 'Widget Editable: 4' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-4' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-4' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-5' ] ) ) {
	$title = $instance[ 'wp-widget-editable-5' ];
}
else {
	$title = __( '..and Payback over time', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-5' ); ?>"><?php _e( 'Widget Editable: 5' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-5' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-5' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-6' ] ) ) {
	$title = $instance[ 'wp-widget-editable-6' ];
}
else {
	$title = __( 'You tell us when and how much to pay back. Interest free terms and flexible payment plans designed to suit you, where you pay off the balance in months, not years.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-6' ); ?>"><?php _e( 'Widget Editable: 6' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-6' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-6' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-7' ] ) ) {
	$title = $instance[ 'wp-widget-editable-7' ];
}
else {
	$title = __( 'zipMoney is a quick, easy and secure way to manage your online shopping', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-7' ); ?>"><?php _e( 'Widget Editable: 7' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-7' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-7' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php }
public function update( $new_instance, $old_instance ) {$instance = array();$instance['wp-widget-editable-0'] = ( ! empty( $new_instance['wp-widget-editable-0'] ) ) ? strip_tags( $new_instance['wp-widget-editable-0'] ) : '';$instance['wp-widget-editable-1'] = ( ! empty( $new_instance['wp-widget-editable-1'] ) ) ? strip_tags( $new_instance['wp-widget-editable-1'] ) : '';$instance['wp-widget-editable-2'] = ( ! empty( $new_instance['wp-widget-editable-2'] ) ) ? strip_tags( $new_instance['wp-widget-editable-2'] ) : '';$instance['wp-widget-editable-3'] = ( ! empty( $new_instance['wp-widget-editable-3'] ) ) ? strip_tags( $new_instance['wp-widget-editable-3'] ) : '';$instance['wp-widget-editable-4'] = ( ! empty( $new_instance['wp-widget-editable-4'] ) ) ? strip_tags( $new_instance['wp-widget-editable-4'] ) : '';$instance['wp-widget-editable-5'] = ( ! empty( $new_instance['wp-widget-editable-5'] ) ) ? strip_tags( $new_instance['wp-widget-editable-5'] ) : '';$instance['wp-widget-editable-6'] = ( ! empty( $new_instance['wp-widget-editable-6'] ) ) ? strip_tags( $new_instance['wp-widget-editable-6'] ) : '';$instance['wp-widget-editable-7'] = ( ! empty( $new_instance['wp-widget-editable-7'] ) ) ? strip_tags( $new_instance['wp-widget-editable-7'] ) : '';return $instance;}
}
add_action( 'widgets_init', function(){
     register_widget( 'homepagehowitworks' );
});
?><?php
class homepagestoreschoose extends WP_Widget {
	public function __construct() {
		$widget_ops = array('classname' => 'homepagestoreschoose', 'description' => 'Webflow generated widget.' );
		$this->WP_Widget('homepagestoreschoose', 'homepagestoreschoose', $widget_ops);
	}
	public function widget( $args, $instance ) {
		$ss_uri = get_stylesheet_directory_uri();
?>
<div class="wp-widget" id="homepage-stores-choose">
      <div class="w-container">
        <h2 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-0"] );?></h2>
        <div class="w-row">
          <div class="w-col w-col-3 w-col-small-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/Merchant-Hustle-Grey.jpg\" alt=\"5357596f3769dde23300024e_Merchant-Hustle-Grey.jpg\">";?>
</div>
          <div class="w-col w-col-3 w-col-small-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/Merchant-Chappelli-Grey.jpg\" alt=\"535759e53f5f51cb360001ec_Merchant-Chappelli-Grey.jpg\">";?>
</div>
          <div class="w-col w-col-3 w-col-small-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/Merchant-CB-Grey.jpg\" alt=\"53575a0f348663c936000232_Merchant-CB-Grey.jpg\">";?>
</div>
          <div class="w-col w-col-3 w-col-small-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/Merchant-Zumi-Grey.png\" alt=\"53575a46348663c93600023b_Merchant-Zumi-Grey.png\">";?>
</div>
        </div>
      </div>
    </div>
<?php
	}
public function form( $instance ) {if ( isset( $instance[ 'wp-widget-editable-0' ] ) ) {
	$title = $instance[ 'wp-widget-editable-0' ];
}
else {
	$title = __( 'Aussie Stores Choose Zipmoney', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-0' ); ?>"><?php _e( 'Widget Editable: 0' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-0' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-0' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php }
public function update( $new_instance, $old_instance ) {$instance = array();$instance['wp-widget-editable-0'] = ( ! empty( $new_instance['wp-widget-editable-0'] ) ) ? strip_tags( $new_instance['wp-widget-editable-0'] ) : '';return $instance;}
}
add_action( 'widgets_init', function(){
     register_widget( 'homepagestoreschoose' );
});
?><?php
class homepagebenefits extends WP_Widget {
	public function __construct() {
		$widget_ops = array('classname' => 'homepagebenefits', 'description' => 'Webflow generated widget.' );
		$this->WP_Widget('homepagebenefits', 'homepagebenefits', $widget_ops);
	}
	public function widget( $args, $instance ) {
		$ss_uri = get_stylesheet_directory_uri();
?>
<div class="wp-widget" id="homepage-benefits">
      <div class="w-container">
        <h2 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-0"] );?></h2>
        <div class="w-row">
          <div class="w-col w-col-3 w-col-small-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/intstant-credit.png\" alt=\"53575ae33f5f51cb360001f5_intstant-credit.png\">";?><h4 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-1"] );?></h4>
            <p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-2"] );?></p>
          </div>
          <div class="w-col w-col-3 w-col-small-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/small-bites.png\" alt=\"53575b393f5f51cb36000214_small-bites.png\">";?><h4 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-3"] );?></h4>
            <p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-4"] );?></p>
          </div>
          <div class="w-col w-col-3 w-col-small-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/Repay-Quickly.png\" alt=\"53575b53348663c93600025e_Repay-Quickly.png\">";?><h4 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-5"] );?></h4>
            <p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-6"] );?></p>
          </div>
          <div class="w-col w-col-3 w-col-small-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/interest-free.png\" alt=\"53575b743769dde23300026e_interest-free.png\">";?><h4 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-7"] );?></h4>
            <p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-8"] );?></p>
          </div>
        </div>
      </div>
    </div>
<?php
	}
public function form( $instance ) {if ( isset( $instance[ 'wp-widget-editable-0' ] ) ) {
	$title = $instance[ 'wp-widget-editable-0' ];
}
else {
	$title = __( 'Say goodbye to your credit card, virtual credit has arrived', 'text_domain' );
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
	$title = __( 'Online Credit', 'text_domain' );
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
	$title = __( 'Apply for credit and get an instant decision. No need to wait in long queues or weeks for the credit card to arrive. Create an ewallet to finance your shopping today.', 'text_domain' );
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
	$title = __( 'Payment Flexibility', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-3' ); ?>"><?php _e( 'Widget Editable: 3' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-3' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-3' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-4' ] ) ) {
	$title = $instance[ 'wp-widget-editable-4' ];
}
else {
	$title = __( 'Pay back in your own time - our slider technology, puts the control back in your hands. Simply select your preferred monthly payment and tailor to your needs.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-4' ); ?>"><?php _e( 'Widget Editable: 4' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-4' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-4' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-5' ] ) ) {
	$title = $instance[ 'wp-widget-editable-5' ];
}
else {
	$title = __( 'Repay Quickly', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-5' ); ?>"><?php _e( 'Widget Editable: 5' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-5' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-5' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-6' ] ) ) {
	$title = $instance[ 'wp-widget-editable-6' ];
}
else {
	$title = __( 'Unlike credit cards, zipMoney has been designed to pay back your balance in months not years. Our objective is to help you pay down your balance fast.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-6' ); ?>"><?php _e( 'Widget Editable: 6' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-6' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-6' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-7' ] ) ) {
	$title = $instance[ 'wp-widget-editable-7' ];
}
else {
	$title = __( 'Interest free', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-7' ); ?>"><?php _e( 'Widget Editable: 7' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-7' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-7' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-8' ] ) ) {
	$title = $instance[ 'wp-widget-editable-8' ];
}
else {
	$title = __( 'Every transaction you make with zipMoney offers a full 3 months interest free. That\'s more than any standard credit card, which offers 25 days from statement date.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-8' ); ?>"><?php _e( 'Widget Editable: 8' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-8' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-8' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php }
public function update( $new_instance, $old_instance ) {$instance = array();$instance['wp-widget-editable-0'] = ( ! empty( $new_instance['wp-widget-editable-0'] ) ) ? strip_tags( $new_instance['wp-widget-editable-0'] ) : '';$instance['wp-widget-editable-1'] = ( ! empty( $new_instance['wp-widget-editable-1'] ) ) ? strip_tags( $new_instance['wp-widget-editable-1'] ) : '';$instance['wp-widget-editable-2'] = ( ! empty( $new_instance['wp-widget-editable-2'] ) ) ? strip_tags( $new_instance['wp-widget-editable-2'] ) : '';$instance['wp-widget-editable-3'] = ( ! empty( $new_instance['wp-widget-editable-3'] ) ) ? strip_tags( $new_instance['wp-widget-editable-3'] ) : '';$instance['wp-widget-editable-4'] = ( ! empty( $new_instance['wp-widget-editable-4'] ) ) ? strip_tags( $new_instance['wp-widget-editable-4'] ) : '';$instance['wp-widget-editable-5'] = ( ! empty( $new_instance['wp-widget-editable-5'] ) ) ? strip_tags( $new_instance['wp-widget-editable-5'] ) : '';$instance['wp-widget-editable-6'] = ( ! empty( $new_instance['wp-widget-editable-6'] ) ) ? strip_tags( $new_instance['wp-widget-editable-6'] ) : '';$instance['wp-widget-editable-7'] = ( ! empty( $new_instance['wp-widget-editable-7'] ) ) ? strip_tags( $new_instance['wp-widget-editable-7'] ) : '';$instance['wp-widget-editable-8'] = ( ! empty( $new_instance['wp-widget-editable-8'] ) ) ? strip_tags( $new_instance['wp-widget-editable-8'] ) : '';return $instance;}
}
add_action( 'widgets_init', function(){
     register_widget( 'homepagebenefits' );
});
?><?php
class homepagemerchantreasons extends WP_Widget {
	public function __construct() {
		$widget_ops = array('classname' => 'homepagemerchantreasons', 'description' => 'Webflow generated widget.' );
		$this->WP_Widget('homepagemerchantreasons', 'homepagemerchantreasons', $widget_ops);
	}
	public function widget( $args, $instance ) {
		$ss_uri = get_stylesheet_directory_uri();
?>
<div class="wp-widget" id="homepage-merchant-reasons">
      <div class="w-container">
        <h2 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-0"] );?></h2>
        <div class="three-box">
          <h3 class="tab-control tab-control-one wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-1"] );?></h3>
          <div class="tab-body tab-body-one">
            <h4 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-2"] );?></h4>
            <h5 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-3"] );?></h5>
            <div class="w-row">
              <div class="w-col w-col-6">
                <h6 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-4"] );?></h6>
                <p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-5"] );?></p>
              </div>
              <div class="w-col w-col-6">
                <h6 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-6"] );?></h6>
                <p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-7"] );?></p>
              </div>
            </div>
            <div class="w-row">
              <div class="w-col w-col-6">
                <h6 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-8"] );?></h6>
                <p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-9"] );?></p>
              </div>
              <div class="w-col w-col-6">
                <h6 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-10"] );?></h6>
                <p class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-11"] );?></p>
              </div>
            </div>
          </div>
          <h3 class="tab-control tab-control-two wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-12"] );?></h3>
          <div class="tab-body tab-body-three">
            <h4>Grow your business online, risk free with no additional investment</h4>
            <h5>Increase your sales risk free with the only product designed exclusively for online shopping.</h5>
            <div class="w-row">
              <div class="w-col w-col-6">
                <h6>Increase Sales and Conversions</h6>
                <p>Convert browsers into shoppers with a simple call to action "Buy Now, Pay Later" on the product or checkout pages.</p>
              </div>
              <div class="w-col w-col-6">
                <h6>Promotional Finance</h6>
                <p>Our platform is incredibly flexible - you can offer attractive financing such as 6 or 12 months interest free and many other extended payment programs.</p>
              </div>
            </div>
            <div class="w-row">
              <div class="w-col w-col-6">
                <h6>Higher Order Values</h6>
                <p>With the ability to set minimum transaction sizes, shopping baskets can be easily upsized. Our core product has a minimum order vaue of $100.</p>
              </div>
              <div class="w-col w-col-6">
                <h6>Purchasing Power</h6>
                <p>You no longer need to be the biggest in town to offer point of sale credit. Compete with the big guys by offering payment terms to your customers.</p>
              </div>
            </div>
          </div>
          <h3 class="tab-control tab-control-three wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-13"] );?></h3>
          <div class="tab-body tab-body-three">
            <h4>Connect with your customers in new ways</h4>
            <h5>Business is built on long-term relationships which reward simplicity, flexibility and experience</h5>
            <div class="w-row">
              <div class="w-col w-col-6">
                <h6>Simplify the Experience</h6>
                <p>Simply download and install the zipMoney plugin for your website. NO integration downtime, NO pain. You can offer credit from your online store in minutes.</p>
              </div>
              <div class="w-col w-col-6">
                <h6>Social Connectivity</h6>
                <p>zipMoney prides itself on social togetherness. When customers sign up they are encouraged to socially connect - this spreads your word.</p>
              </div>
            </div>
            <div class="w-row">
              <div class="w-col w-col-6">
                <h6>Reward Loyalty</h6>
                <p>Customise a loyalty program for your shoppers such as free shipping, dollars off, or more time to pay. Build customer retention and grow your fan base.</p>
              </div>
              <div class="w-col w-col-6">
                <h6>Social Scoring</h6>
                <p>zipMoney employs the latest in social scoring to assess potential customers. Our alternative approach to underwriting means we can cast the net much wider than others</p>
              </div>
            </div>
          </div>
        </div>
<a class="button btn-center" href="#">Sign Me Up Today</a>
      </div>
    </div>
<?php
	}
public function form( $instance ) {if ( isset( $instance[ 'wp-widget-editable-0' ] ) ) {
	$title = $instance[ 'wp-widget-editable-0' ];
}
else {
	$title = __( 'Why Choose zipMoney for your site?', 'text_domain' );
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
	$title = __( 'Connect With Customers', 'text_domain' );
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
	$title = __( 'Offer credit online to your customers with zipMoney', 'text_domain' );
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
	$title = __( 'Increase your sales risk free with the only product designed&nbsp;exclusively for online shopping.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-3' ); ?>"><?php _e( 'Widget Editable: 3' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-3' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-3' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-4' ] ) ) {
	$title = $instance[ 'wp-widget-editable-4' ];
}
else {
	$title = __( 'Easy Setup', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-4' ); ?>"><?php _e( 'Widget Editable: 4' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-4' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-4' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-5' ] ) ) {
	$title = $instance[ 'wp-widget-editable-5' ];
}
else {
	$title = __( 'Simply download and install the zipMoney plugin for your website. NO integration downtime, NO pain. You can offer credit from your online store in minutes.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-5' ); ?>"><?php _e( 'Widget Editable: 5' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-5' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-5' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-6' ] ) ) {
	$title = $instance[ 'wp-widget-editable-6' ];
}
else {
	$title = __( 'Get Paid Fast', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-6' ); ?>"><?php _e( 'Widget Editable: 6' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-6' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-6' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-7' ] ) ) {
	$title = $instance[ 'wp-widget-editable-7' ];
}
else {
	$title = __( 'Funds from settled transactions are deposited directly into your bank account. We guarantee to disburse payment within 24 hours from delivery confirmation.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-7' ); ?>"><?php _e( 'Widget Editable: 7' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-7' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-7' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-8' ] ) ) {
	$title = $instance[ 'wp-widget-editable-8' ];
}
else {
	$title = __( 'Simple Pricing', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-8' ); ?>"><?php _e( 'Widget Editable: 8' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-8' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-8' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-9' ] ) ) {
	$title = $instance[ 'wp-widget-editable-9' ];
}
else {
	$title = __( 'NO setup fees and NO long-term contracts. Simply pay a small fee per transaction, like any other payment gateway. Our pricing can fit businesses of all sizes.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-9' ); ?>"><?php _e( 'Widget Editable: 9' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-9' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-9' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-10' ] ) ) {
	$title = $instance[ 'wp-widget-editable-10' ];
}
else {
	$title = __( 'Zero Fraud Risk', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-10' ); ?>"><?php _e( 'Widget Editable: 10' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-10' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-10' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-11' ] ) ) {
	$title = $instance[ 'wp-widget-editable-11' ];
}
else {
	$title = __( 'Say goodbye to fraud chargebacks with zipMoney\'s&nbsp;Seller Protection. We have partnered with global leaders in cybercrime prevention where fraud is stopped real-time.', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-11' ); ?>"><?php _e( 'Widget Editable: 11' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-11' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-11' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-12' ] ) ) {
	$title = $instance[ 'wp-widget-editable-12' ];
}
else {
	$title = __( 'Grow Your Business', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-12' ); ?>"><?php _e( 'Widget Editable: 12' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-12' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-12' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php if ( isset( $instance[ 'wp-widget-editable-13' ] ) ) {
	$title = $instance[ 'wp-widget-editable-13' ];
}
else {
	$title = __( 'Offer Credit', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-13' ); ?>"><?php _e( 'Widget Editable: 13' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-13' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-13' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php }
public function update( $new_instance, $old_instance ) {$instance = array();$instance['wp-widget-editable-0'] = ( ! empty( $new_instance['wp-widget-editable-0'] ) ) ? strip_tags( $new_instance['wp-widget-editable-0'] ) : '';$instance['wp-widget-editable-1'] = ( ! empty( $new_instance['wp-widget-editable-1'] ) ) ? strip_tags( $new_instance['wp-widget-editable-1'] ) : '';$instance['wp-widget-editable-2'] = ( ! empty( $new_instance['wp-widget-editable-2'] ) ) ? strip_tags( $new_instance['wp-widget-editable-2'] ) : '';$instance['wp-widget-editable-3'] = ( ! empty( $new_instance['wp-widget-editable-3'] ) ) ? strip_tags( $new_instance['wp-widget-editable-3'] ) : '';$instance['wp-widget-editable-4'] = ( ! empty( $new_instance['wp-widget-editable-4'] ) ) ? strip_tags( $new_instance['wp-widget-editable-4'] ) : '';$instance['wp-widget-editable-5'] = ( ! empty( $new_instance['wp-widget-editable-5'] ) ) ? strip_tags( $new_instance['wp-widget-editable-5'] ) : '';$instance['wp-widget-editable-6'] = ( ! empty( $new_instance['wp-widget-editable-6'] ) ) ? strip_tags( $new_instance['wp-widget-editable-6'] ) : '';$instance['wp-widget-editable-7'] = ( ! empty( $new_instance['wp-widget-editable-7'] ) ) ? strip_tags( $new_instance['wp-widget-editable-7'] ) : '';$instance['wp-widget-editable-8'] = ( ! empty( $new_instance['wp-widget-editable-8'] ) ) ? strip_tags( $new_instance['wp-widget-editable-8'] ) : '';$instance['wp-widget-editable-9'] = ( ! empty( $new_instance['wp-widget-editable-9'] ) ) ? strip_tags( $new_instance['wp-widget-editable-9'] ) : '';$instance['wp-widget-editable-10'] = ( ! empty( $new_instance['wp-widget-editable-10'] ) ) ? strip_tags( $new_instance['wp-widget-editable-10'] ) : '';$instance['wp-widget-editable-11'] = ( ! empty( $new_instance['wp-widget-editable-11'] ) ) ? strip_tags( $new_instance['wp-widget-editable-11'] ) : '';$instance['wp-widget-editable-12'] = ( ! empty( $new_instance['wp-widget-editable-12'] ) ) ? strip_tags( $new_instance['wp-widget-editable-12'] ) : '';$instance['wp-widget-editable-13'] = ( ! empty( $new_instance['wp-widget-editable-13'] ) ) ? strip_tags( $new_instance['wp-widget-editable-13'] ) : '';return $instance;}
}
add_action( 'widgets_init', function(){
     register_widget( 'homepagemerchantreasons' );
});
?><?php
class homepagepartners extends WP_Widget {
	public function __construct() {
		$widget_ops = array('classname' => 'homepagepartners', 'description' => 'Webflow generated widget.' );
		$this->WP_Widget('homepagepartners', 'homepagepartners', $widget_ops);
	}
	public function widget( $args, $instance ) {
		$ss_uri = get_stylesheet_directory_uri();
?>
<div class="wp-widget" id="homepage-partners">
      <div class="w-container">
        <h2 class="wp-widget-editable"><?php echo apply_filters( "widget_title", $instance["wp-widget-editable-0"] );?></h2>
        <div class="w-row">
          <div class="w-col w-col-2 w-col-small-4 w-col-tiny-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/threatmetrix.gif\" alt=\"535761ed3769dde2330002aa_threatmetrix.gif\">";?>
</div>
          <div class="w-col w-col-2 w-col-small-4 w-col-tiny-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/veda.gif\" alt=\"5357620f3769dde2330002ac_veda.gif\">";?>
</div>
          <div class="w-col w-col-2 w-col-small-4 w-col-tiny-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/kiva.gif\" alt=\"5357627c3f5f51cb3600028f_kiva.gif\">";?>
</div>
          <div class="w-col w-col-2 w-col-small-4 w-col-tiny-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/fos.gif\" alt=\"535762943769dde2330002b2_fos.gif\">";?>
</div>
          <div class="w-col w-col-2 w-col-small-4 w-col-tiny-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/getseal.gif\" alt=\"535762ad3f5f51cb36000292_getseal.gif\">";?>
</div>
          <div class="w-col w-col-2 w-col-small-4 w-col-tiny-6">
            <?php echo "<img class=\"img-center\" src=\"$ss_uri/images/23.gif\" alt=\"535762c73769dde2330002b7_23.gif\">";?>
</div>
        </div>
      </div>
    </div>
<?php
	}
public function form( $instance ) {if ( isset( $instance[ 'wp-widget-editable-0' ] ) ) {
	$title = $instance[ 'wp-widget-editable-0' ];
}
else {
	$title = __( 'Some of our partners include'../wordpress/, 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'wp-widget-editable-0' ); ?>"><?php _e( 'Widget Editable: 0' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'wp-widget-editable-0' ); ?>" name="<?php echo $this->get_field_name( 'wp-widget-editable-0' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
</p>
<?php }
public function update( $new_instance, $old_instance ) {$instance = array();$instance['wp-widget-editable-0'] = ( ! empty( $new_instance['wp-widget-editable-0'] ) ) ? strip_tags( $new_instance['wp-widget-editable-0'] ) : '';return $instance;}
}
add_action( 'widgets_init', function(){
     register_widget( 'homepagepartners' );
});
?><?php
function homepagebanner() {
	/* Register a dynamic sidebar. */
	register_sidebar(
		array(
			'id' => 'homepage-banner',
			'name' => __( 'homepage-banner' ),
			'description' => __( 'homepage-banner' ),
		)
	);
}
add_action('widgets_init','homepagebanner');
?><?php
function homepagemain() {
	/* Register a dynamic sidebar. */
	register_sidebar(
		array(
			'id' => 'homepage-main',
			'name' => __( 'homepage-main' ),
			'description' => __( 'homepage-main' ),
		)
	);
}
add_action('widgets_init','homepagemain');
?>