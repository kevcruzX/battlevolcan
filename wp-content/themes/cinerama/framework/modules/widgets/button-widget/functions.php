<?php

if ( ! function_exists( 'cinerama_edge_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function cinerama_edge_register_button_widget( $widgets ) {
		$widgets[] = 'CineramaEdgeClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'cinerama_edge_filter_register_widgets', 'cinerama_edge_register_button_widget' );
}