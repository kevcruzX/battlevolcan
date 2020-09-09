<?php

if ( ! function_exists( 'cinerama_edge_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function cinerama_edge_register_social_icon_widget( $widgets ) {
		$widgets[] = 'CineramaEdgeClassSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'cinerama_edge_filter_register_widgets', 'cinerama_edge_register_social_icon_widget' );
}