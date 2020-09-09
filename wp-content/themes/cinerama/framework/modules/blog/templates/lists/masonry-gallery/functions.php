<?php

if ( ! function_exists( 'cinerama_edge_register_blog_masonry_gallery_template_file' ) ) {
	/**
	 * Function that register blog masonry gallery template
	 */
	function cinerama_edge_register_blog_masonry_gallery_template_file( $templates ) {
		$templates['blog-masonry-gallery'] = esc_html__( 'Blog: Masonry Gallery', 'cinerama' );
		
		return $templates;
	}
	
	add_filter( 'cinerama_edge_filter_register_blog_templates', 'cinerama_edge_register_blog_masonry_gallery_template_file' );
}

if ( ! function_exists( 'cinerama_edge_set_blog_masonry_gallery_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function cinerama_edge_set_blog_masonry_gallery_type_global_option( $options ) {
		$options['masonry-gallery'] = esc_html__( 'Blog: Masonry Gallery', 'cinerama' );
		
		return $options;
	}
	
	add_filter( 'cinerama_edge_filter_blog_list_type_global_option', 'cinerama_edge_set_blog_masonry_gallery_type_global_option' );
}