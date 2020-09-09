<?php

if ( ! function_exists( 'cinerama_edge_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function cinerama_edge_register_blog_list_widget( $widgets ) {
		$widgets[] = 'CineramaEdgeClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'cinerama_edge_filter_register_widgets', 'cinerama_edge_register_blog_list_widget' );
}