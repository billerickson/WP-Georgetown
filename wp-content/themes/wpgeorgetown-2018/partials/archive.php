<?php
/**
 * Archive partial
 *
 * @package      WPGeorgetown2018
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

echo '<article class="' . join( ' ', get_post_class() ) . '">';

	echo '<header class="entry-header">';
		echo '<h2 class="entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
		tha_entry_top();
	echo '</header>';

	echo '<div class="entry-content">';
		ea_presentation_header();
		the_excerpt();
	echo '</div>';

echo '</article>';
