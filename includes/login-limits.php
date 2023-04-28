<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
// Define maximum number of login attempts
define( 'WP_LOGIN_ATTEMPTS', 3 );

// Add filter to limit login attempts
add_filter( 'authenticate', 'wp_login_attempts_limit', 30, 3 );

function wp_login_attempts_limit( $user, $username, $password ) {
    $login_count = (int) get_user_meta( $user->ID, '_login_attempts', true );
    
    if ( $login_count >= WP_LOGIN_ATTEMPTS ) {
        // Lockout user after maximum number of attempts
        add_action( 'wp_login_failed', 'wp_login_attempts_lockout', 10, 1 );
        return new WP_Error( 'too_many_attempts', __( '<strong>ERROR</strong>: You have exceeded the maximum number of login attempts. Please try again later.' ) );
    } else {
        // Increment login attempt count
        update_user_meta( $user->ID, '_login_attempts', $login_count + 1 );
        return $user;
    }
}

function wp_login_attempts_lockout( $username ) {
    $user = get_user_by( 'login', $username );
    if ( $user ) {
        // Lockout user
        update_user_meta( $user->ID, '_login_attempts_lockout', time() );
    }
}

// Add filter to check if user is locked out
add_filter( 'authenticate', 'wp_login_attempts_check_lockout', 40, 3 );

function wp_login_attempts_check_lockout( $user, $username, $password ) {
    $user_id = username_exists( $username );
    $lockout_time = (int) get_user_meta( $user_id, '_login_attempts_lockout', true );
    
    if ( $lockout_time && ( time() - $lockout_time ) < 300 ) {
        // User is locked out for 5 minutes
        return new WP_Error( 'too_many_attempts', __( '<strong>ERROR</strong>: You have exceeded the maximum number of login attempts. Please try again later.' ) );
    } else {
        // User is not locked out
        return $user;
    }
}

// Add action to reset login attempt count on successful login
add_action( 'wp_login', 'wp_login_attempts_reset', 10, 2 );

function wp_login_attempts_reset( $user_login, $user ) {
    delete_user_meta( $user->ID, '_login_attempts' );
    delete_user_meta( $user->ID, '_login_attempts_lockout' );
}
