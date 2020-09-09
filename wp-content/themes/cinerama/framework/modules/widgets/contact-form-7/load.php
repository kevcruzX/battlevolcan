<?php

if ( cinerama_edge_contact_form_7_installed() ) {
	include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'cinerama_edge_filter_register_widgets', 'cinerama_edge_register_cf7_widget' );
}

if ( ! function_exists( 'cinerama_edge_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function cinerama_edge_register_cf7_widget( $widgets ) {
		$widgets[] = 'CineramaEdgeClassContactForm7Widget';
		
		return $widgets;
	}
}