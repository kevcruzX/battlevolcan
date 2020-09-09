<?php

if ( ! function_exists( 'cinerama_edge_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function cinerama_edge_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'CineramaEdgeClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'cinerama_edge_filter_register_widgets', 'cinerama_edge_register_sidearea_opener_widget' );
}