<?php

if ( ! function_exists( 'cinerama_edge_set_title_standard_type_for_options' ) ) {
	/**
	 * This function set standard title type value for title options map and meta boxes
	 */
	function cinerama_edge_set_title_standard_type_for_options( $type ) {
		$type['standard'] = esc_html__( 'Standard', 'cinerama' );
		
		return $type;
	}
	
	add_filter( 'cinerama_edge_filter_title_type_global_option', 'cinerama_edge_set_title_standard_type_for_options' );
	add_filter( 'cinerama_edge_filter_title_type_meta_boxes', 'cinerama_edge_set_title_standard_type_for_options' );
}

if ( ! function_exists( 'cinerama_edge_set_title_standard_type_as_default_options' ) ) {
	/**
	 * This function set default title type value for global title option map
	 */
	function cinerama_edge_set_title_standard_type_as_default_options( $type ) {
		$type = 'standard';
		
		return $type;
	}
	
	add_filter( 'cinerama_edge_filter_default_title_type_global_option', 'cinerama_edge_set_title_standard_type_as_default_options' );
}