<?php

if ( ! function_exists( 'cinerama_edge_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function cinerama_edge_register_separator_widget( $widgets ) {
		$widgets[] = 'CineramaEdgeClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'cinerama_edge_filter_register_widgets', 'cinerama_edge_register_separator_widget' );
}