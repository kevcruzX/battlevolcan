<?php

if ( ! function_exists( 'cinerama_edge_register_blog_standard_template_file' ) ) {
	/**
	 * Function that register blog standard template
	 */
	function cinerama_edge_register_blog_standard_template_file( $templates ) {
		$templates['blog-standard'] = esc_html__( 'Blog: Standard', 'cinerama' );
		
		return $templates;
	}
	
	add_filter( 'cinerama_edge_filter_register_blog_templates', 'cinerama_edge_register_blog_standard_template_file' );
}

if ( ! function_exists( 'cinerama_edge_set_blog_standard_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function cinerama_edge_set_blog_standard_type_global_option( $options ) {
		$options['standard'] = esc_html__( 'Blog: Standard', 'cinerama' );
		
		return $options;
	}
	
	add_filter( 'cinerama_edge_filter_blog_list_type_global_option', 'cinerama_edge_set_blog_standard_type_global_option' );
}