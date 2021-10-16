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

if (!function_exists('wpuser_firstname_shortcode')){
    function wpuser_firstname_shortcode($atts) {
        $user = wp_get_current_user();
        $firstname = $user->first_name;
        $display_firstname = $firstname;

        // display output
        return $display_firstname;
    }
}

if (!function_exists('wpuser_lastname_shortcode')){
    function wpuser_lastname_shortcode($atts) {
        $user = wp_get_current_user();
        $lastname = $user->last_name;
        $display_lastname = $lastname;

        // display output
        return $display_lastname;
    }
}

// wordpress hook
add_shortcode('wpuser_firstname', 'wpuser_firstname_shortcode');
add_shortcode('wpuser_lastname', 'wpuser_lastname_shortcode');

// Current day.
add_shortcode('wpinfo_current_day', 'wp_info_current_day_shortcode');
if (!function_exists('wp_info_current_day_shortcode')){
    function wp_info_current_day_shortcode() {
        return gmdate( 'l' );
    }
}

// Current month.
add_shortcode('wpinfo_current_month', 'wp_info_current_month_shortcode');
if (!function_exists('wp_info_current_month_shortcode')){
    function wp_info_current_month_shortcode() {
        return gmdate( 'F' );
    }
}

// Current year.
add_shortcode('wpinfo_current_year', 'wp_info_current_year_shortcode');
if (!function_exists('wp_info_current_year_shortcode')){
    function wp_info_current_year_shortcode() {
        return gmdate( 'Y' );
    }
}
/**
 * Current date
 *
 * – Allow the user to select their own format.
 * – Else fallback to the default option.
 */
add_shortcode('wpinfo_current_date', 'wp_info_current_date_shortcode');
if (!function_exists('wp_info_current_date_shortcode')){
    function wp_info_current_date_shortcode($atts) {
        $default_date_format = get_option( 'date_format' );
        $atts = shortcode_atts( array(
            'format' => $default_date_format,
        ), $atts );
        return gmdate( $atts['format'] );
    }
}

// query param shortcode
add_shortcode('wpuser_query_param', 'wp_info_get_query_param_shortcode');
if (!function_exists('wp_info_get_query_param_shortcode')){
    function wp_info_get_query_param_shortcode($atts){
        $atts = shortcode_atts( array(
            'arg' => false,
        ), $atts);
        return isset( $_GET[ $atts['arg'] ] ) ? sanitize_text_field( $_GET[ $atts['arg'] ] ) : false;
    }
}
