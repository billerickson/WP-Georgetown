<?php
/**
 * Template Name: Meetup / CSS Grid
 * Template Post Type: post
 *
 * @package      WPGeorgetown2018
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Load page-specific css
 *
 */
function ea_css_grid_meetup_css() {
	wp_enqueue_style( 'css-grid-meetup', get_stylesheet_directory_uri() . '/assets/css/meetup-css-grid.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/meetup-css-grid.css' ) );
}
add_action( 'wp_enqueue_scripts', 'ea_css_grid_meetup_css' );

// Build the page
require get_template_directory() . '/index.php';
