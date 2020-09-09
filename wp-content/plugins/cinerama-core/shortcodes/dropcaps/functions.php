<?php

if ( ! function_exists( 'cinerama_core_add_dropcaps_shortcodes' ) ) {
	function cinerama_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'CineramaCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'cinerama_core_filter_add_vc_shortcode', 'cinerama_core_add_dropcaps_shortcodes' );
}