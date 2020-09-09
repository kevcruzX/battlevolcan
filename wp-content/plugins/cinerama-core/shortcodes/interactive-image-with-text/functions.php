<?php

if ( ! function_exists( 'cinerama_core_add_interactive_image_with_text_shortcodes' ) ) {
	function cinerama_core_add_interactive_image_with_text_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'CineramaCore\CPT\Shortcodes\InteractiveImageWithText\InteractiveImageWithText'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'cinerama_core_filter_add_vc_shortcode', 'cinerama_core_add_interactive_image_with_text_shortcodes' );
}

if ( ! function_exists( 'cinerama_core_set_interactive_image_with_text_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for interactive image with text shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function cinerama_core_set_interactive_image_with_text_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-interactive-image-with-text';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'cinerama_core_filter_add_vc_shortcodes_custom_icon_class', 'cinerama_core_set_interactive_image_with_text_icon_class_name_for_vc_shortcodes' );
}