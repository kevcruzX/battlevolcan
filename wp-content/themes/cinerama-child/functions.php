<?php

/*** Child Theme Function  ***/

if ( ! function_exists( 'cinerama_edge_child_theme_enqueue_scripts' ) ) {
	function cinerama_edge_child_theme_enqueue_scripts() {
		$parent_style = 'cinerama-edge-default-style';
		
		wp_enqueue_style( 'cinerama-edge-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'cinerama_edge_child_theme_enqueue_scripts' );
}