<?php
/**
 * Custom Fields
 *
 * @package      CoreFunctionality
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Register Fields
 *
 */
function ea_register_custom_fields() {

	Container::make( 'post_meta', 'Meetup Details' )
		->where( 'post_type', '=', 'post' )
		->add_fields( array(
			Field::make( 'text', 'ea_meetup_url', 'Meetup URL' )
		));
}
add_action( 'carbon_fields_register_fields', 'ea_register_custom_fields' );
