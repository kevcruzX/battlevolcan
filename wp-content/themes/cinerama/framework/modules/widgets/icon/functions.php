<?php

if ( ! function_exists( 'cinerama_edge_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function cinerama_edge_register_icon_widget( $widgets ) {
		$widgets[] = 'CineramaEdgeClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'cinerama_edge_filter_register_widgets', 'cinerama_edge_register_icon_widget' );
}