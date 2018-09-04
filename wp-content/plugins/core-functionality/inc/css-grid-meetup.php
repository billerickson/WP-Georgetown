<?php
/**
 * CSS Grid Meetup
 *
 * @package      CoreFunctionality
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * CSS Grid Meetup
 *
 */
function ea_css_grid_meetup( $atts = array() ) {

	$atts = shortcode_atts( array(
		'example' => false,
	), $atts, 'css_grid_meetup' );

	$example = intval( $atts['example'] );
	if( empty( $example ) )
		return;

	$css = $markup = false;

	switch( $example ) {

		case 1:
			$css =
".grid1 {
	display: grid;
	grid-template-columns: 50px 100px 150px;
	grid-template-rows: 150px 100px 50px;
	grid-gap: 20px;
}";
			$markup = ea_css_build_grid( 'grid1', 9 );
			break;

		case 2:
			$css =
".grid2 {
	display: grid;
	grid-template-columns: 50px 100px 150px;
	grid-template-rows: 150px 100px 50px;
	grid-gap: 20px;
}

.item {
	min-height: 40px;
}";
			$markup = ea_css_build_grid( 'grid2', 14 );
			break;

		case 3:
			$css =
".grid3 {
	display: grid;
	grid-template-columns: 50px 100px 150px;
	grid-template-rows: 150px 100px 50px;
	grid-gap: 20px;
	grid-auto-rows: 100px;
}

.item {
	min-height: 40px;
}";
			$markup = ea_css_build_grid( 'grid3', 14 );
			break;

		case 4:
			$css =
".grid4 {
	border: 2px solid black;
	display: grid;
	grid-template-columns: 75% 25%;
	grid-gap: 20px;
}

.item {
	min-height: 40px;
}";
			$markup = ea_css_build_grid( 'grid4', 4 );
			break;

		case 5:
			$css =
".grid5 {
	border: 2px solid black;
	display: grid;
	grid-template-columns: 75% auto;
	grid-gap: 20px;
}

.item {
	min-height: 40px;
}";
			$markup = ea_css_build_grid( 'grid5', 4 );
			break;

		case 6:
			$css =
".grid6 {
	display: grid;
	grid-template-columns: 1fr 1fr 1fr;
	grid-gap: 20px;
}";
			$markup = ea_css_build_grid( 'grid6', 6 );
			break;

		case 7:
			$css =
".grid7 {
	display: grid;
	grid-template-columns: 1fr 2fr 1fr;
	grid-gap: 20px;
}";
			$markup = ea_css_build_grid( 'grid7', 6 );
			break;

		case 8:
			$css =
".grid8 {
	display: grid;
	grid-template-columns: 1fr 1fr 1fr;
	grid-gap: 20px;
}

.grid8 .item:nth-child(2) {
	width: 300px;
	background: #00aa37;
}";
			$markup = ea_css_build_grid( 'grid8', 6 );
			break;

		case 9:
			$css =
".grid9 {
	display: grid;
	grid-template-columns: repeat( 6, 1fr );
	grid-gap: 12px;
}";
			$markup = ea_css_build_grid( 'grid9', 12 );
			break;

		case 10:
			$css =
".grid10 {
	display: grid;
	grid-template-columns: repeat( 4, 1fr );
	grid-gap: 20px;
}

.grid10 .item:nth-child(2) {
	grid-column: span 2;
	background: #00aa37;
}";
			$markup = ea_css_build_grid( 'grid10', 7 );
			break;

		case 11:
			$css =
".grid11 {
	display: grid;
	grid-template-columns: repeat( 4, 1fr );
	grid-gap: 20px;
}

.grid10 .item:nth-child(2) {
	grid-column: 2 / 4;
	background: #00aa37;
}";
			$markup = ea_css_build_grid( 'grid11', 7 );
			break;

		case 12:

		$css =
".grid12 {
	display: grid;
	grid-template-columns: repeat( 3, 1fr );
	grid-gap: 12px;
}

@media only screen and (max-width: 767px) {
	.grid12 {
		grid-template-columns: repeat( 2, 1fr );
	}
}


.grid12 header,
.grid12 nav {
	background: #f0f0f0;
	grid-column: 1 / -1;
	text-align: center;
}

.grid12 article {
	font-size: 12px;
	color: #fff;
	padding: 4px;
}";
			$markup = '<section class="grid12">';
			$markup .= '<header><h4>Category name goes here</h4></header>';
			for( $i = 0; $i < 7; $i++ ) {
				$markup .= '<article class="item">Lorem ipsum dolor sit amet</article>';
			}
			$markup .= '<nav>Pagination goes here</nav>';
			$markup .= '</section>';
			break;

		case 13:

			$css =
".grid13 {
	display: grid;
	grid-template-columns: repeat( 2, 1fr );
	grid-gap: 12px;
	align-items: center;
}";
			$markup = '<div class="grid13">';
				$markup .= '<div class="item"><p>This grid item is smaller and centered.</p></div>';
				$markup .= '<div class="item"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quid enim tanto opus est instrumento in optimis artibus comparandis? Ut placet, inquit, etsi enim illud erat aptius, aequum cuique concedere. Dolor ergo, id est summum malum, metuetur semper, etiamsi non aderit; Et quidem iure fortasse, sed tamen non gravissimum est testimonium multitudinis.</p></div>';
			$markup .= '</div>';
			break;

		case 14:

			$css =
".grid14 {
	overflow: hidden;
	width: 100%;
}

.grid14 .item-content-area {
	float: left;
	width: 70%;
}

.grid14 .item-sidebar {
	float: right;
	width: 20%;
}

@supports( display: grid ) {
	.grid14 {
		display: grid;
		grid-template-columns: 1fr 200px;
		grid-column-gap: 16px;
	}

	.grid14 .item-content-area,
	.grid14 .item-sidebar {
		float: none;
		width: 100%;
	}
}";

			$markup = '<div class="grid14">';
			$markup .= '<div class="item item-content-area">This is the content area</div>';
			$markup .= '<div class="item item-sidebar">This is the sidebar</div>';
			$markup .= '</div>';
			break;
	}

	$output = '<div class="example">';
	$output .= '<pre>' . $css . '</pre>';
	$output .= $markup;
	$output .= '</div>';
	return $output;

}
add_shortcode( 'css_grid_meetup', 'ea_css_grid_meetup' );

/**
 * Build Grid
 *
 */
function ea_css_build_grid( $wrapper_class = '', $items = 1 ) {
	$output = '<div class="' . sanitize_html_class( $wrapper_class ) . '">';
	for( $i = 0; $i < $items; $i++ ) {
		$output .= '<div class="item"></div>';
	}
	$output .= '</div>';
	return $output;
}
