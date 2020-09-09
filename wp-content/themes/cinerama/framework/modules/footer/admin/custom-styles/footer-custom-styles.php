<?php

if ( ! function_exists( 'cinerama_edge_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function cinerama_edge_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = cinerama_edge_options()->getOptionValue( 'footer_top_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo cinerama_edge_dynamic_css( '.edgtf-page-footer .edgtf-footer-top-holder', $item_styles );
	}
	
	add_action( 'cinerama_edge_action_style_dynamic', 'cinerama_edge_footer_top_general_styles' );
}

if ( ! function_exists( 'cinerama_edge_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function cinerama_edge_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = cinerama_edge_options()->getOptionValue( 'footer_bottom_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo cinerama_edge_dynamic_css( '.edgtf-page-footer .edgtf-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'cinerama_edge_action_style_dynamic', 'cinerama_edge_footer_bottom_general_styles' );
}