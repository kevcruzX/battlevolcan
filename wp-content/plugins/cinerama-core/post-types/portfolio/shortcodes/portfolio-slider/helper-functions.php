<?php

if ( ! function_exists( 'cinerama_core_add_portfolio_slider_shortcode' ) ) {
	function cinerama_core_add_portfolio_slider_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'CineramaCore\CPT\Shortcodes\Portfolio\PortfolioSlider'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'cinerama_core_filter_add_vc_shortcode', 'cinerama_core_add_portfolio_slider_shortcode' );
}

if ( ! function_exists( 'cinerama_core_set_portfolio_slider_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for portfolio slider shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function cinerama_core_set_portfolio_slider_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-portfolio-slider';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'cinerama_core_filter_add_vc_shortcodes_custom_icon_class', 'cinerama_core_set_portfolio_slider_icon_class_name_for_vc_shortcodes' );
}