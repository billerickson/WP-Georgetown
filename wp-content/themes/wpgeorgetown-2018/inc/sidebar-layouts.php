<?php
/**
 * Sidebar Layouts
 *
 * @package      WPGeorgetown2018
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

 /**
  * Register widget area.
  *
  * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
  */
 function ea_widgets_init() {

 	register_sidebar( ea_widget_area_args( array(
 		'name' => esc_html__( 'Primary Sidebar', 'ea' ),
 	) ) );

 }
 add_action( 'widgets_init', 'ea_widgets_init' );

 /**
  * Layout Body Class
  *
  */
function ea_layout_body_class( $classes ) {

  $classes[] = ea_page_layout();
  return $classes;
}
add_filter( 'body_class', 'ea_layout_body_class', 5 );

 /**
  * Page Layout
  *
  */
 function ea_page_layout() {

 	$available_layouts = array( 'full-width-content', 'content-sidebar', 'sidebar-content' );
 	$layout = 'full-width-content';

 	$layout = apply_filters( 'ea_page_layout', $layout );
 	$layout = in_array( $layout, $available_layouts ) ? $layout : $available_layouts[0];

 	return sanitize_title_with_dashes( $layout );
 }

 /**
  * Return Full Width Content
  * used when filtering 'ea_page_layout'
  */
 function ea_return_full_width_content() {
 	return 'full-width-content';
 }

 /**
  * Return Content Sidebar
  * used when filtering 'ea_page_layout'
  */
 function ea_return_content_sidebar() {
 	return 'content-sidebar';
 }

 /**
  * Return Sidebar Content
  * used when filtering 'ea_page_layout'
  */
 function ea_return_sidebar_content() {
 	return 'sidebar-content';
 }
