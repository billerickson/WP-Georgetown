<?php
/**
 * Single Post
 *
 * @package      WPGeorgetown2018
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Subscribe CTA
 *
 */
function ea_single_subscribe_cta() {

	if( ! function_exists( 'ea_cf' ) )
		return;

	$cta = ea_cf( 'ea_after_post_cta', ea_first_term( 'category', 'term_id' ), array( 'type' => 'term_meta' ) );
	if( empty( $cta ) )
		return;

	echo '<div class="after-post-cta">' . apply_filters( 'ea_the_content', $cta ) . '</div>';
}
add_action( 'tha_entry_after', 'ea_single_subscribe_cta' );

// Build the page
require get_template_directory() . '/index.php';
