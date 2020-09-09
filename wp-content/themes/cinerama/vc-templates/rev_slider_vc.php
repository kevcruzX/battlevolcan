<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $alias
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_Rev_Slider_Vc
 */
$title = $alias = $el_class = '';

/***** Our code modification - begin *****/
$enable_paspartu = $paspartu_size = $disable_side_paspartu = $disable_top_paspartu = '';
/***** Our code modification - end *****/
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_revslider_element wpb_content_element' . $el_class, $this->settings['base'], $atts );

/***** Our code modification - begin *****/

$edgtf_rev_style = array();

if ( $enable_paspartu === 'yes' ) {
	$css_class .= ' edgtf-rev-has-paspartu';
	
	if ( ! empty( $paspartu_size ) ) {
		$css_class .= ' edgtf-paspartu-' . $paspartu_size;
	}
	
	if ( $disable_side_paspartu === 'yes' ) {
		$css_class .= ' edgtf-side-paspartu-disabled';
	}
	
	if ( $disable_top_paspartu === 'yes' ) {
		$css_class .= ' edgtf-top-paspartu-disabled';
	}
}

$output .= '<div class="' . esc_attr( $css_class ) . '">';

/***** Our code modification - end *****/
$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_revslider_heading' ) );
$output .= apply_filters( 'vc_revslider_shortcode', do_shortcode( '[rev_slider ' . $alias . ']' ) );
$output .= '</div>';

echo cinerama_edge_get_module_part($output);
