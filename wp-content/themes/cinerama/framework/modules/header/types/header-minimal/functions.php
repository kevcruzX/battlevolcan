<?php

if ( ! function_exists( 'cinerama_edge_register_header_minimal_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function cinerama_edge_register_header_minimal_type( $header_types ) {
		$header_type = array(
			'header-minimal' => 'CineramaEdgeNamespace\Modules\Header\Types\HeaderMinimal'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'cinerama_edge_init_register_header_minimal_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function cinerama_edge_init_register_header_minimal_type() {
		add_filter( 'cinerama_edge_filter_register_header_type_class', 'cinerama_edge_register_header_minimal_type' );
	}
	
	add_action( 'cinerama_edge_action_before_header_function_init', 'cinerama_edge_init_register_header_minimal_type' );
}

if ( ! function_exists( 'cinerama_edge_include_header_minimal_full_screen_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function cinerama_edge_include_header_minimal_full_screen_menu( $menus ) {
		$menus['popup-navigation'] = esc_html__( 'Full Screen Navigation', 'cinerama' );
		
		return $menus;
	}
	
	if ( cinerama_edge_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_filter( 'cinerama_edge_filter_register_headers_menu', 'cinerama_edge_include_header_minimal_full_screen_menu' );
	}
}

if ( ! function_exists( 'cinerama_edge_get_fullscreen_menu_icon_class' ) ) {
	/**
	 * Loads full screen menu icon class
	 */
	function cinerama_edge_get_fullscreen_menu_icon_class() {
		$classes = array(
			'edgtf-fullscreen-menu-opener'
		);
		
		$classes[] = cinerama_edge_get_icon_sources_class( 'fullscreen_menu', 'edgtf-fullscreen-menu-opener' );
		
		return $classes;
	}
}

if ( ! function_exists( 'cinerama_edge_register_header_minimal_full_screen_menu_widgets' ) ) {
	/**
	 * Registers additional widget areas for this header type
	 */
	function cinerama_edge_register_header_minimal_full_screen_menu_widgets() {
		register_sidebar(
			array(
				'id'            => 'fullscreen_menu_widget',
				'name'          => esc_html__( 'Fullscreen Menu Widget', 'cinerama' ),
				'description'   => esc_html__( 'This widget area is rendered on the left side of full screen menu', 'cinerama' ),
				'before_widget' => '<div class="%2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="edgtf-widget-title">',
				'after_title'   => '</h5>'
			)
		);
	}
	
	if ( cinerama_edge_check_is_header_type_enabled( 'header-minimal' ) ) {
		add_action( 'widgets_init', 'cinerama_edge_register_header_minimal_full_screen_menu_widgets' );
	}
}