<?php
/**
* Plugin Name: Shortcodes WP
* Plugin URI: https://github.com/warengonzaga/shortcodes-wp
* Description: A WordPress shortcode plugin to automagically display WordPress information. Simple and lightweight, no annoying ads and fancy settings.
* Version: 1.0.0
* Author: Waren Gonzaga
* Author URI: https://warengonzaga.com
*/

/**
* WP Update Your Footer
*/

// prevent direct access
defined( 'ABSPATH' ) or die( "Restricted Access!" );

function user_firstname($atts) {
    $user = wp_get_current_user();
    $firstname = $user->first_name;
    $display_firstname = $firstname;

    // display output
    return $display_firstname;
}

function user_lastname($atts) {
    $user = wp_get_current_user();
    $lastname = $user->last_name;
    $display_lastname = $lastname;

    // display output
    return $display_lastname;
}

// wordpress hook
add_shortcode('wpuser_firstname', 'user_firstname');
add_shortcode('wpuser_lastname', 'user_lastname');

// Current day.
add_shortcode('wpinfo_current_day', 'current_day');
function current_day() {
    return gmdate( 'l' );
}

// Current month.
add_shortcode('wpinfo_current_month', 'current_month');
function current_month() {
    return gmdate( 'F' );
}

// Current year.
add_shortcode('wpinfo_current_year', 'current_year');
function current_year() {
    return gmdate( 'Y' );
}

/**
 * Current date
 *
 * – Allow the user to select their own format.
 * – Else fallback to the default option.
 */
add_shortcode('wpinfo_current_date', 'current_date');
function current_date($atts) {
    $default_date_format = get_option( 'date_format' );
    $atts = shortcode_atts( array(
        'format' => $default_date_format,
    ), $atts );
    return gmdate( $atts['format'] );
}
