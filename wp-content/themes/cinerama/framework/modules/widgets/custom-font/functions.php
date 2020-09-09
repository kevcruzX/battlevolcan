<?php

if ( ! function_exists( 'cinerama_edge_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function cinerama_edge_register_custom_font_widget( $widgets ) {
		$widgets[] = 'CineramaEdgeClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'cinerama_edge_filter_register_widgets', 'cinerama_edge_register_custom_font_widget' );
}