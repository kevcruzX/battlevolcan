<?php

if(!function_exists('cinerama_edge_register_sticky_sidebar_widget')) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function cinerama_edge_register_sticky_sidebar_widget($widgets) {
		$widgets[] = 'CineramaEdgeClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter('cinerama_edge_filter_register_widgets', 'cinerama_edge_register_sticky_sidebar_widget');
}