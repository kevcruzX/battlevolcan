<?php

if ( ! function_exists( 'cinerama_edge_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function cinerama_edge_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'CineramaEdgeClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'cinerama_edge_filter_register_widgets', 'cinerama_edge_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'cinerama_edge_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function cinerama_edge_get_dropdown_cart_icon_class() {
		$classes = array(
			'edgtf-header-cart'
		);
		
		$classes[] = cinerama_edge_get_icon_sources_class( 'dropdown_cart', 'edgtf-header-cart' );
		
		return $classes;
	}
}