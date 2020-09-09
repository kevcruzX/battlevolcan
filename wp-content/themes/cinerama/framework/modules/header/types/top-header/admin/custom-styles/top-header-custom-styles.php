<?php

if ( ! function_exists( 'cinerama_edge_header_top_bar_styles' ) ) {
	/**
	 * Generates styles for header top bar
	 */
	function cinerama_edge_header_top_bar_styles() {
		$top_header_height = cinerama_edge_options()->getOptionValue( 'top_bar_height' );
		
		if ( ! empty( $top_header_height ) ) {
			echo cinerama_edge_dynamic_css( '.edgtf-top-bar', array( 'height' => cinerama_edge_filter_px( $top_header_height ) . 'px' ) );
			echo cinerama_edge_dynamic_css( '.edgtf-top-bar .edgtf-logo-wrapper a', array( 'max-height' => cinerama_edge_filter_px( $top_header_height ) . 'px' ) );
		}
		
		echo cinerama_edge_dynamic_css( '.edgtf-header-box .edgtf-top-bar-background', array( 'height' => cinerama_edge_get_top_bar_background_height() . 'px' ) );
		
		$top_bar_container_selector = '.edgtf-top-bar > .edgtf-vertical-align-containers';
		$top_bar_container_styles   = array();
		$container_side_padding     = cinerama_edge_options()->getOptionValue( 'top_bar_side_padding' );
		
		if ( $container_side_padding !== '' ) {
			if ( cinerama_edge_string_ends_with( $container_side_padding, 'px' ) || cinerama_edge_string_ends_with( $container_side_padding, '%' ) ) {
				$top_bar_container_styles['padding-left'] = $container_side_padding;
				$top_bar_container_styles['padding-right'] = $container_side_padding;
			} else {
				$top_bar_container_styles['padding-left'] = cinerama_edge_filter_px( $container_side_padding ) . 'px';
				$top_bar_container_styles['padding-right'] = cinerama_edge_filter_px( $container_side_padding ) . 'px';
			}
			
			echo cinerama_edge_dynamic_css( $top_bar_container_selector, $top_bar_container_styles );
		}
		
		if ( cinerama_edge_options()->getOptionValue( 'top_bar_in_grid' ) == 'yes' ) {
			$top_bar_grid_selector                = '.edgtf-top-bar .edgtf-grid .edgtf-vertical-align-containers';
			$top_bar_grid_styles                  = array();
			$top_bar_grid_background_color        = cinerama_edge_options()->getOptionValue( 'top_bar_grid_background_color' );
			$top_bar_grid_background_transparency = cinerama_edge_options()->getOptionValue( 'top_bar_grid_background_transparency' );
			
			if ( !empty($top_bar_grid_background_color) ) {
				$grid_background_color        = $top_bar_grid_background_color;
				$grid_background_transparency = 1;
				
				if ( $top_bar_grid_background_transparency !== '' ) {
					$grid_background_transparency = $top_bar_grid_background_transparency;
				}
				
				$grid_background_color                   = cinerama_edge_rgba_color( $grid_background_color, $grid_background_transparency );
				$top_bar_grid_styles['background-color'] = $grid_background_color;
			}
			
			echo cinerama_edge_dynamic_css( $top_bar_grid_selector, $top_bar_grid_styles );
		}
		
		$top_bar_styles   = array();
		$background_color = cinerama_edge_options()->getOptionValue( 'top_bar_background_color' );
		$border_color     = cinerama_edge_options()->getOptionValue( 'top_bar_border_color' );
		
		if ( $background_color !== '' ) {
			$background_transparency = 1;
			if ( cinerama_edge_options()->getOptionValue( 'top_bar_background_transparency' ) !== '' ) {
				$background_transparency = cinerama_edge_options()->getOptionValue( 'top_bar_background_transparency' );
			}
			
			$background_color                   = cinerama_edge_rgba_color( $background_color, $background_transparency );
			$top_bar_styles['background-color'] = $background_color;
			
			echo cinerama_edge_dynamic_css( '.edgtf-header-box .edgtf-top-bar-background', array( 'background-color' => $background_color ) );
		}
		
		if ( cinerama_edge_options()->getOptionValue( 'top_bar_border' ) == 'yes' && $border_color != '' ) {
			$top_bar_styles['border-bottom'] = '1px solid ' . $border_color;
		}
		
		echo cinerama_edge_dynamic_css( '.edgtf-top-bar', $top_bar_styles );
	}
	
	add_action( 'cinerama_edge_action_style_dynamic', 'cinerama_edge_header_top_bar_styles' );
}