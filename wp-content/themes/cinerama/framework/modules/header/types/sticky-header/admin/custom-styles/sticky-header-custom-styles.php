<?php

if ( ! function_exists( 'cinerama_edge_sticky_header_styles' ) ) {
	/**
	 * Generates styles for sticky haeder
	 */
	function cinerama_edge_sticky_header_styles() {
		$background_color        = cinerama_edge_options()->getOptionValue( 'sticky_header_background_color' );
		$background_transparency = cinerama_edge_options()->getOptionValue( 'sticky_header_transparency' );
		$border_color            = cinerama_edge_options()->getOptionValue( 'sticky_header_border_color' );
		$header_height           = cinerama_edge_options()->getOptionValue( 'sticky_header_height' );
		
		if ( ! empty( $background_color ) ) {
			$header_background_color              = $background_color;
			$header_background_color_transparency = 1;
			
			if ( $background_transparency !== '' ) {
				$header_background_color_transparency = $background_transparency;
			}
			
			echo cinerama_edge_dynamic_css( '.edgtf-page-header .edgtf-sticky-header .edgtf-sticky-holder', array( 'background-color' => cinerama_edge_rgba_color( $header_background_color, $header_background_color_transparency ) ) );
		}
		
		if ( ! empty( $border_color ) ) {
			echo cinerama_edge_dynamic_css( '.edgtf-page-header .edgtf-sticky-header .edgtf-sticky-holder', array( 'border-color' => $border_color ) );
		}
		
		if ( ! empty( $header_height ) ) {
			$height = cinerama_edge_filter_px( $header_height ) . 'px';
			
			echo cinerama_edge_dynamic_css( '.edgtf-page-header .edgtf-sticky-header', array( 'height' => $height ) );
			echo cinerama_edge_dynamic_css( '.edgtf-page-header .edgtf-sticky-header .edgtf-logo-wrapper a', array( 'max-height' => $height ) );
		}
		
		$sticky_container_selector = '.edgtf-sticky-header .edgtf-sticky-holder .edgtf-vertical-align-containers';
		$sticky_container_styles   = array();
		$container_side_padding    = cinerama_edge_options()->getOptionValue( 'sticky_header_side_padding' );
		
		if ( $container_side_padding !== '' ) {
			if ( cinerama_edge_string_ends_with( $container_side_padding, 'px' ) || cinerama_edge_string_ends_with( $container_side_padding, '%' ) ) {
				$sticky_container_styles['padding-left']  = $container_side_padding;
				$sticky_container_styles['padding-right'] = $container_side_padding;
			} else {
				$sticky_container_styles['padding-left']  = cinerama_edge_filter_px( $container_side_padding ) . 'px';
				$sticky_container_styles['padding-right'] = cinerama_edge_filter_px( $container_side_padding ) . 'px';
			}
			
			echo cinerama_edge_dynamic_css( $sticky_container_selector, $sticky_container_styles );
		}
		
		// sticky menu style
		
		$menu_item_styles = cinerama_edge_get_typography_styles( 'sticky' );
		
		$menu_item_selector = array(
			'.edgtf-main-menu.edgtf-sticky-nav > ul > li > a'
		);
		
		echo cinerama_edge_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		
		$hover_color = cinerama_edge_options()->getOptionValue( 'sticky_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.edgtf-main-menu.edgtf-sticky-nav > ul > li:hover > a',
			'.edgtf-main-menu.edgtf-sticky-nav > ul > li.edgtf-active-item > a'
		);
		
		echo cinerama_edge_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
	}
	
	add_action( 'cinerama_edge_action_style_dynamic', 'cinerama_edge_sticky_header_styles' );
}