<?php

if ( ! function_exists( 'cinerama_edge_disable_behaviors_for_header_vertical_sliding' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function cinerama_edge_disable_behaviors_for_header_vertical_sliding( $allow_behavior ) {
		return false;
	}
	
	if ( cinerama_edge_check_is_header_type_enabled( 'header-vertical-sliding', cinerama_edge_get_page_id() ) ) {
		add_filter( 'cinerama_edge_filter_allow_sticky_header_behavior', 'cinerama_edge_disable_behaviors_for_header_vertical_sliding' );
		add_filter( 'cinerama_edge_filter_allow_content_boxed_layout', 'cinerama_edge_disable_behaviors_for_header_vertical_sliding' );
	}
}