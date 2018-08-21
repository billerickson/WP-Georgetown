<?php
/**
 * Helper Functions
 *
 * @package      WPGeorgetown2018
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

// Duplicate 'the_content' filters
global $wp_embed;
add_filter( 'ea_the_content', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'ea_the_content', array( $wp_embed, 'autoembed'     ), 8 );
add_filter( 'ea_the_content', 'wptexturize'        );
add_filter( 'ea_the_content', 'convert_chars'      );
add_filter( 'ea_the_content', 'wpautop'            );
add_filter( 'ea_the_content', 'shortcode_unautop'  );
add_filter( 'ea_the_content', 'do_shortcode'       );

/**
 * Get the first term attached to post
 *
 * @param string $taxonomy
 * @param string/int $field, pass false to return object
 * @param int $post_id
 * @return string/object
 */
function ea_first_term( $taxonomy = 'category', $field = false, $post_id = false ) {

	$post_id = $post_id ? $post_id : get_the_ID();
	$term = false;

	// Use WP SEO Primary Term
	// from https://github.com/Yoast/wordpress-seo/issues/4038
	if( class_exists( 'WPSEO_Primary_Term' ) ) {
		$term = get_term( ( new WPSEO_Primary_Term( $taxonomy,  $post_id ) )->get_primary_term(), $taxonomy );
	}

	// Fallback on term with highest post count
	if( ! $term || is_wp_error( $term ) ) {

		$terms = get_the_terms( $post_id, $taxonomy );

		if( empty( $terms ) || is_wp_error( $terms ) )
			return false;

		// If there's only one term, use that
		if( 1 == count( $terms ) ) {
			$term = array_shift( $terms );

		// If there's more than one...
		} else {

			// Sort by term order if available
			// @uses WP Term Order plugin
			if( isset( $terms[0]->order ) ) {
				$list = array();
				foreach( $terms as $term )
					$list[$term->order] = $term;
				ksort( $list, SORT_NUMERIC );

			// Or sort by post count
			} else {
				$list = array();
				foreach( $terms as $term )
					$list[$term->count] = $term;
				ksort( $list, SORT_NUMERIC );
				$list = array_reverse( $list );
			}

			$term = array_shift( $list );
		}
	}

	// Output
	if( $field && isset( $term->$field ) )
		return $term->$field;

	else
		return $term;
}

/**
 * Conditional CSS Classes
 *
 * @param string $base_classes, classes always applied
 * @param string $optional_class, additional class applied if $conditional is true
 * @param bool $conditional, whether to add $optional_class or not
 * @return string $classes
 */
function ea_class( $base_classes, $optional_class, $conditional ) {
	return $conditional ? $base_classes . ' ' . $optional_class : $base_classes;
}

/**
 * Column Classes
 *
 * Adds "-first" classes when appropriate for clearing float
 * @see /assets/scss/partials/layout.scss
 *
 * @param array $classes, bootstrap-style classes, ex: array( 'col-lg-4', 'col-md-6' )
 * @param int $current, current post in loop
 * @param bool $join, whether to join classes (return string) or not (return array)
 * @return string/array $classes
 */
function ea_column_class( $classes = array(), $current = false, $join = true ) {

	if( false === $current )
		return $classes;

	$columns = array( 2, 3, 4, 6 );
	foreach( $columns as $column ) {
		if( 0 == $current % $column ) {

			$col = 12 / $column;
			foreach( $classes as $class ) {
				if( false != strstr( $class, (string) $col ) && false == strstr( $class, '12' ) ) {
					$classes[] = str_replace( $col, 'first', $class );
				}
			}
		}
	}

	if( $join ) {
		return join( ' ', $classes );
	} else {
		return $classes;
	}
}

/**
 *  Background Image Style
 *
 * @param int $image_id
 * @return string $output
 */
function ea_bg_image_style( $image_id = false, $image_size = 'full' ) {
	if( !empty( $image_id ) )
		return ' style="background-image: url(' . wp_get_attachment_image_url( $image_id, $image_size ) . ');"';
}

/**
 * Get Icon
 *
 */
function ea_icon( $slug = '' ) {
	$icon_path = get_template_directory() . '/assets/icons/' . $slug . '.svg';
	if( file_exists( $icon_path ) )
		return file_get_contents( $icon_path );
}

/**
 * Join Multiple Items
 * Separate last two items by 'and', remaining by commas
 * Ex: item 1, item 2 and item 3
 */
function ea_join_multiple( $items ) {

	if ( empty( $items ) ) {
		$output = '';

	} elseif ( 1 == count( $items ) ) {
		$output = $items[0];

	} else {
		// Combine all but last partial using commas.
		$output = implode( ', ', array_slice( $items, 0, -1 ) );
		// Add 'and' separator.
		$output .= ' and ';
		// Add last partial.
		$output .= end( $items );
	}

	return $output;
}

/**
 * Default Widget Area Arguments
 *
 * @param array $args
 * @return array $args
 */
function ea_widget_area_args( $args = array() ) {

   $defaults = array(
	   'name'          => '',
	   'id'            => '',
	   'description'   => '',
	   'before_widget' => '<section id="%1$s" class="widget %2$s">',
	   'after_widget'  => '</section>',
	   'before_title'  => '<h4 class="widget-title">',
	   'after_title'   => '</h4>',
   );
   $args = wp_parse_args( $args, $defaults );

   if( !empty( $args['name'] ) && empty( $args['id'] ) )
	   $args['id'] = sanitize_title_with_dashes( $args['name'] );

   return $args;

}

/**
 * Presentation Header
 *
 */
function ea_presentation_header() {

	if( ! in_category( 'meetup-summary' ) )
		return;

	$presenter = ea_first_term( 'presenter' );
	$presenter = !empty( $presenter ) && ! is_wp_error( $presenter ) ? '<span class="presenter">Presented by ' . $presenter->name . '</span>' : '';

	echo '<div class="presentation-header">';
		echo '<h2>' . get_the_title() . '</h2>';
		echo '<div class="byline">';
			echo ea_icon( 'wordpress' );
			echo '<span class="meetup">' . get_bloginfo( 'name' ) . '</span>';
			echo $presenter;
		echo '</div>';
		if( ! is_singular() )
			echo '<a href="' . get_permalink() . '" class="block-link"><span class="screen-reader-text">' . get_the_title() . '</span></a>';
	echo '</div>';
}
