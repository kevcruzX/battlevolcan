<?php

if ( ! function_exists( 'cinerama_edge_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function cinerama_edge_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'CineramaEdgeClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'cinerama_edge_filter_register_widgets', 'cinerama_edge_register_image_gallery_widget' );
}