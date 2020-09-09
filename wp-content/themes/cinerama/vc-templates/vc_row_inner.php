<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $equal_height
 * @var $content_placement
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$el_class = $equal_height = $content_placement = $css = $el_id = '';
$disable_element = '';
$output = $after_output = '';

/***** Our code modification - begin *****/

$row_content_width = $content_text_aligment = $simple_background_color = $simple_background_image = $disable_background_image = '';
$edgtf_row_wrapper_start = $edgtf_row_wrapper_end = '';

/***** Our code modification - end *****/

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_inner',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') )) {
	$css_classes[]='vc_row-has-fill';
}

if (!empty($atts['gap'])) {
	$css_classes[] = 'vc_column-gap-'.$atts['gap'];
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

/***** Our code modification - begin *****/

$grid_row_class = $grid_row_data = $edgtf_vc_row_style = $edgtf_grid_row_style = array();

if ( $row_content_width !== 'grid' ) {
	if (!empty($disable_background_image)){
		$css_classes[] = 'edgtf-disabled-bg-image-bellow-' . esc_attr($disable_background_image);
	}
	
	if ( ! empty( $simple_background_color ) ) {
		$edgtf_vc_row_style[] = 'background-color:' . esc_attr( $simple_background_color );
	}
	
	if ( ! empty( $simple_background_image ) ) {
		$image_src            = wp_get_attachment_image_src($simple_background_image, 'full');
		$edgtf_vc_row_style[] = 'background-image: url(' . esc_url( $image_src[0] ) . ')';
	}
	
	if (!empty($content_text_aligment)){
		$css_classes[] = 'edgtf-content-aligment-' . esc_attr($content_text_aligment);
	}
	
} else {
	if (!empty($disable_background_image)){
		$grid_row_class[] = 'edgtf-disabled-bg-image-bellow-' . esc_attr($disable_background_image);
	}
	
	if ( ! empty( $simple_background_color ) ) {
		$edgtf_grid_row_style[] = 'background-color:' . esc_attr( $simple_background_color );
	}
	
	if ( ! empty( $simple_background_image ) ) {
		$image_src            = wp_get_attachment_image_src($simple_background_image, 'full');
		$edgtf_grid_row_style[] = 'background-image: url(' . esc_url( $image_src[0] ) . ')';
	}
	
	if (!empty($content_text_aligment)){
		$grid_row_class[] = 'edgtf-content-aligment-' . esc_attr($content_text_aligment);
	}
}

$grid_row_classes = '';
if( ! empty( $grid_row_class ) ) {
	$grid_row_classes = implode( ' ', $grid_row_class );
}

$edgtf_vc_row_styles = '';
if( ! empty( $edgtf_vc_row_style ) ) {
	$edgtf_vc_row_styles = implode( ';', $edgtf_vc_row_style );
}

$edgtf_grid_row_styles = '';
if( ! empty( $edgtf_grid_row_style ) ) {
	$edgtf_grid_row_styles = implode( ';', $edgtf_grid_row_style );
}

if($row_content_width === 'grid'){
	$edgtf_row_wrapper_start .= '<div class="edgtf-row-grid-section-wrapper '.esc_attr($grid_row_classes).'" ' . cinerama_edge_get_inline_style( $edgtf_grid_row_styles ) . '><div class="edgtf-row-grid-section">';
	$edgtf_row_wrapper_end .= '</div></div>';
}

/***** Our code modification - end *****/

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= $edgtf_row_wrapper_start;
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' ' . cinerama_edge_get_inline_style( $edgtf_vc_row_styles ) . '>';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $edgtf_row_wrapper_end;
$output .= $after_output;

echo cinerama_edge_get_module_part($output);
