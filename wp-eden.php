<?php
/*
Plugin Name: WP Eden
Plugin URI: https://eden.bz/
Description: Useful functions created by Eden Design & Digital Solutions
Version: 1.0.0
Author: Hamidreza(Hoomaan) Sheikholeslami
Author URI: https://hoomaan.dev/
License: GPLv2 or later
Text Domain: wp-eden
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Include footer.php file
include_once( plugin_dir_path( __FILE__ ) . '/includes/footer.php' );

// Add custom admin footer text
add_filter( 'admin_footer_text', 'custom_admin_footer' );

// Include security.php file
include_once( plugin_dir_path( __FILE__ ) . '/includes/security.php' );

// Include login-limits.php file
include_once( plugin_dir_path( __FILE__ ) . '/includes/login-limits.php' );