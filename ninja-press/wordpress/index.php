<!DOCTYPE html>
<!-- This site was created in Webflow. http://www.webflow.com--><!-- Last Published: Sun Apr 27 2014 11:49:08 GMT+0000 (UTC) --><html data-wf-site="53550af9dd03896220000a2d">
<head>
<meta charset="utf-8">
<title>Filter.io</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="generator" content="Webflow">
<?php $uri = get_stylesheet_directory_uri();
echo "<script type='text/javascript' src='$uri/js/modernizr.js'/></script>";?><link rel="shortcut icon" type="image/x-icon" href="https://y7v4p6k4.ssl.hwcdn.net/placeholder/favicon.ico">
<link rel="stylesheet" type="text/css" href="style.css">
<?php $href = get_stylesheet_uri();
echo "<link rel='stylesheet' type='text/css' href='$href'>";?>
</head>
<body>
  <div>
    <div class="w-nav" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
      <div class="w-container">
<a class="w-nav-brand" href="#"><h1>Site Title</h1></a>
        <nav class="w-nav-menu" role="navigation"><a class="w-nav-link" href="#">Home</a><a class="w-nav-link" href="#">About</a><a class="w-nav-link" href="#">Contact</a>
        </nav><div class="w-nav-button">
          <div class="w-icon-nav-menu"></div>
        </div>
      </div>
    </div>
  </div>
  <div class="wp-sidebar" id="header-banner"><?php dynamic_sidebar("header-banner");?></div>
  <div>
    <div class="w-container">
      <div class="w-row">
        <div class="w-col w-col-9 wp-the-loop">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
          <div class="wp-the-loop-pagination">
          <?php get_template_part( 'pagination' );?>
</div>
          <div class="wp-the-post">
            <h2 class="wp-the-title"><?php the_title();?></h2>
            <p class="wp-the-excerpt"><?php the_excerpt();?></p>
            <p class="wp-the-time"><?php the_time('F jS, Y');?></p>
          </div>
          
          
          <div class="wp-the-loop-pagination">
          <?php get_template_part( 'pagination' );?>
</div>
        <?php endwhile;endif;?>
</div>
        <div class="w-col w-col-3">
          <h3>Widget</h3>
          <p>This is some widget content.</p>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script><?php $uri = get_stylesheet_directory_uri();
echo "<script type='text/javascript' src='$uri/js/webflow.js'/></script>";?><!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
</body>
</html>
