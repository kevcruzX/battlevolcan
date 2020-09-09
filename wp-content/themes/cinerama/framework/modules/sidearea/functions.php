<?php

if ( ! function_exists( 'cinerama_edge_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function cinerama_edge_register_side_area_sidebar() {
		register_sidebar(
			array(
				'id'            => 'sidearea',
				'name'          => esc_html__( 'Side Area', 'cinerama' ),
				'description'   => esc_html__( 'Side Area', 'cinerama' ),
				'before_widget' => '<div id="%1$s" class="widget edgtf-sidearea %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="edgtf-widget-title-holder"><h5 class="edgtf-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'cinerama_edge_register_side_area_sidebar' );
}

if ( ! function_exists( 'cinerama_edge_side_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different side menu styles
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function cinerama_edge_side_menu_body_class( $classes ) {
		
		if ( is_active_widget( false, false, 'edgtf_side_area_opener' ) ) {
			
			if ( cinerama_edge_options()->getOptionValue( 'side_area_type' ) ) {
				$classes[] = 'edgtf-' . cinerama_edge_options()->getOptionValue( 'side_area_type' );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'cinerama_edge_side_menu_body_class' );
}

if ( ! function_exists( 'cinerama_edge_get_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function cinerama_edge_get_side_area() {
		
		if ( is_active_widget( false, false, 'edgtf_side_area_opener' ) ) {
			$parameters = array(
				'close_icon_classes' => cinerama_edge_get_side_area_close_icon_class()
			);
			
			cinerama_edge_get_module_template_part( 'templates/sidearea', 'sidearea', '', $parameters );
		}
	}
	
	add_action( 'cinerama_edge_action_after_body_tag', 'cinerama_edge_get_side_area', 10 );
}

if ( ! function_exists( 'cinerama_edge_get_side_area_close_class' ) ) {
	/**
	 * Loads side area close icon class
	 */
	function cinerama_edge_get_side_area_close_icon_class() {
		$classes = array(
			'edgtf-close-side-menu'
		);
		
		$classes[] = cinerama_edge_get_icon_sources_class( 'side_area', 'edgtf-close-side-menu' );
		
		return $classes;
	}
}