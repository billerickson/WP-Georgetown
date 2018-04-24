<?php
/**
 * Loop
 *
 * @package      WPGeorgetown2018
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Default Loop
 *
 */
function ea_default_loop() {

	if ( have_posts() ) :

		tha_content_while_before();

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			tha_entry_before();

			$partial = apply_filters( 'ea_loop_partial', is_singular() ? 'content' : 'archive' );
			$context = apply_filters( 'ea_loop_partial_context', is_search() ? 'search' : get_post_type() );
			get_template_part( 'partials/' . $partial, $context );

			tha_entry_after();

		endwhile;

		tha_content_while_after();

	else :

		tha_entry_before();
		$context = apply_filters( 'ea_empty_loop_partial_context', 'none' );
		get_template_part( 'partials/archive', $context );
		tha_entry_after();

	endif;

}
add_action( 'tha_content_loop', 'ea_default_loop' );

/**
 * Post Comments
 *
 */
function ea_comments() {

	if ( is_single() && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}

}
add_action( 'tha_content_while_after', 'ea_comments' );

/**
 * Entry Meta
 *
 */
function ea_entry_meta() {

	if( 'post' != get_post_type() )
		return;

	$output = '<span class="entry-date">' . get_the_date( 'F j, Y' ) . '</span>';

	$presenters = get_the_terms( get_the_ID(), 'presenter' );
	if( !( empty( $presenters ) || is_wp_error( $presenters ) ) ) {
		$list = array();
		foreach( $presenters as $presenter )
			$list[] = '<a href="' . get_term_link( $presenter, 'presenter' ) . '">' . $presenter->name . '</a>';
		$output .= ' <span class="presenter">Presented by ' . ea_join_multiple( $list ) . '</span>';
	}

	$meetup_url = esc_url_raw( ea_cf( 'ea_meetup_url' ) );
	if( $meetup_url )
		$output .= ' <a class="meetup-link" href="' . $meetup_url . '">View on Meetup.org</a>';

	if( !empty( $output ) )
		echo '<p class="entry-meta">' . $output . '</p>';
}
add_action( 'tha_entry_top', 'ea_entry_meta' );
