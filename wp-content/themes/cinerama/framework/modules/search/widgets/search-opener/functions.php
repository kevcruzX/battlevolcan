<?php

if ( ! function_exists( 'cinerama_edge_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function cinerama_edge_register_search_opener_widget( $widgets ) {
		$widgets[] = 'CineramaEdgeClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'cinerama_edge_filter_register_widgets', 'cinerama_edge_register_search_opener_widget' );
}