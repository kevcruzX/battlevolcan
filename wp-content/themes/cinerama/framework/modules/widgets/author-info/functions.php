<?php

if ( ! function_exists( 'cinerama_edge_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function cinerama_edge_register_author_info_widget( $widgets ) {
		$widgets[] = 'CineramaEdgeClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'cinerama_edge_filter_register_widgets', 'cinerama_edge_register_author_info_widget' );
}