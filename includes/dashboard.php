<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Change the login page logo
function wpb_login_logo() { ?>
  <style type="text/css">
      #login h1 a, .login h1 a {
          background-image: url(http://path/to/your/custom-logo.png);
      height:100px;
      width:300px;
      background-size: 300px 100px;
      background-repeat: no-repeat;
      padding-bottom: 10px;
      }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'wpb_login_logo' );

// Change the login page logo URL
function wpb_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'wpb_login_logo_url' );
  
function wpb_login_logo_url_title() {
    return 'Your Site Name and Info';
}
add_filter( 'login_headertitle', 'wpb_login_logo_url_title' );