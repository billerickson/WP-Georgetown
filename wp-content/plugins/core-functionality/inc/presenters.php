<?php
/**
 * Presenters
 *
 * @package      CoreFunctionality
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Register Presenters Taxonomy
 *
 */
function ea_register_presenters_taxonomy() {

	$labels = array(
		'name'                       => 'Presenter',
		'singular_name'              => 'Presenter',
		'search_items'               => 'Search Presenters',
		'popular_items'              => 'Popular Presenters',
		'all_items'                  => 'All Presenters',
		'parent_item'                => 'Parent Presenter',
		'parent_item_colon'          => 'Parent Presenter:',
		'edit_item'                  => 'Edit Presenter',
		'update_item'                => 'Update Presenter',
		'add_new_item'               => 'Add New Presenter',
		'new_item_name'              => 'New Presenter',
		'separate_items_with_commas' => 'Separate Presenters with commas',
		'add_or_remove_items'        => 'Add or remove Presenters',
		'choose_from_most_used'      => 'Choose from most used Presenters',
		'menu_name'                  => 'Presenters',
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_ui'           => true,
		'show_tagcloud'     => false,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		'rewrite'           => array( 'slug' => 'presenter', 'with_front' => false ),
		'query_var'         => true,
		'show_admin_column' => true,
		// 'meta_box_cb'    => false,
	);
	register_taxonomy( 'presenter', array( 'post' ), $args );
}
add_action( 'init', 'ea_register_presenters_taxonomy' );
