<?php
/**
 * Shortcodes
 *
 * @package      CoreFunctionality
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Upcoming Meetups
 *
 */
function ea_upcoming_meetups_shortcode( $atts = array() ) {

	$atts = shortcode_atts( array(
		'count' => 5,
		'meetup' => 'georgetown-tx-wordpress',
	), $atts, 'upcoming_meetups' );

	$key = 'upcoming_meetups_' . sanitize_title( $atts['meetup'] ) . '_' . intval( $atts['count'] );
	$output = get_transient( $key );
	if( false === $output ) {

		$query_args = array(
			'sign' => 'true',
			'photo-host' => 'public',
			'page' => intval( $atts['count'] ),
		);

		$request_uri = 'https://api.meetup.com/' . sanitize_title( $atts['meetup'] ) . '/events';
		$request = wp_remote_get( add_query_arg( $query_args, $request_uri ) );

		if( is_wp_error( $request ) || '200' != wp_remote_retrieve_response_code( $request ) )
			return;

		$events = json_decode( wp_remote_retrieve_body( $request ) );
		if( empty( $events ) )
			return;

		$output = '<ul>';
		foreach( $events as $event ) {
			$date = strtotime( $event->local_date . ' ' . $event->local_time );
			$output .= sprintf(
				'<li><a href="%s">%s</a> on %s at %s</li>',
				esc_url_raw( $event->link ),
				esc_html( $event->name ),
				date( 'F jS', $date ),
				date( 'g:ia', $date )
			);
		}
		$output .= '</ul>';

		set_transient( $key, $output, DAY_IN_SECONDS );
	}

	return $output;
}
add_shortcode( 'upcoming_meetups', 'ea_upcoming_meetups_shortcode' );
