<?php
/**
 * Functions
 *
 * @package      WPGeorgetown2018
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Home Header
 *
 */
function ea_home_header() {
	echo '<div class="home-header"><div class="wrap">';
	dynamic_sidebar( 'home-header' );
	echo '</div></div>';
}
add_action( 'tha_header_after', 'ea_home_header' );

// Build the page
require get_template_directory() . '/archive.php';
