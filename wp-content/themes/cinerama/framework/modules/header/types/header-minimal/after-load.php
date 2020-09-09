<?php

if ( ! function_exists( 'cinerama_edge_get_header_minimal_full_screen_menu' ) ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function cinerama_edge_get_header_minimal_full_screen_menu() {
		$parameters = array(
			'fullscreen_menu_in_grid' => cinerama_edge_options()->getOptionValue( 'fullscreen_in_grid' ) === 'yes' ? true : false
		);
		
		cinerama_edge_get_module_template_part( 'templates/full-screen-menu', 'header/types/header-minimal', '', $parameters );
	}
	
	if ( cinerama_edge_check_is_header_type_enabled( 'header-minimal', cinerama_edge_get_page_id() ) ) {
		add_action( 'cinerama_edge_action_after_wrapper_inner', 'cinerama_edge_get_header_minimal_full_screen_menu', 40 );
	}
}

if ( ! function_exists( 'cinerama_edge_header_minimal_mobile_menu_module' ) ) {
    /**
     * Function that edits module for mobile menu
     *
     * @param $module - default module value
     *
     * @return string name of module
     */
    function cinerama_edge_header_minimal_mobile_menu_module( $module ) {
        return 'header/types/header-minimal';
    }

    if ( cinerama_edge_check_is_header_type_enabled( 'header-minimal', cinerama_edge_get_page_id() ) ) {
        add_filter('cinerama_edge_filter_mobile_menu_module', 'cinerama_edge_header_minimal_mobile_menu_module');
    }
}

if ( ! function_exists( 'cinerama_edge_header_minimal_mobile_menu_slug' ) ) {
    /**
     * Function that edits slug for mobile menu
     *
     * @param $slug - default slug value
     *
     * @return string name of slug
     */
    function cinerama_edge_header_minimal_mobile_menu_slug( $slug ) {
        return 'minimal';
    }

    if ( cinerama_edge_check_is_header_type_enabled( 'header-minimal', cinerama_edge_get_page_id() ) ) {
        add_filter('cinerama_edge_filter_mobile_menu_slug', 'cinerama_edge_header_minimal_mobile_menu_slug');
    }
}

if ( ! function_exists( 'cinerama_edge_header_minimal_mobile_menu_parameters' ) ) {
    /**
     * Function that edits parameters for mobile menu
     *
     * @param $parameters - default parameters array values
     *
     * @return array of default values and classes for minimal mobile header
     */
    function cinerama_edge_header_minimal_mobile_menu_parameters( $parameters ) {

		$parameters['fullscreen_menu_icon_class'] = cinerama_edge_get_fullscreen_menu_icon_class();

        return $parameters;
    }

    if ( cinerama_edge_check_is_header_type_enabled( 'header-minimal', cinerama_edge_get_page_id() ) ) {
        add_filter('cinerama_edge_filter_mobile_menu_parameters', 'cinerama_edge_header_minimal_mobile_menu_parameters');
    }
}