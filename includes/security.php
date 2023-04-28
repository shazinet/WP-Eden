<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


// Disable file editor
define( 'DISALLOW_FILE_EDIT', true );

// Disable XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );