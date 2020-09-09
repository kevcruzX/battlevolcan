<?php

if ( ! function_exists( 'cinerama_edge_get_blog_holder_params' ) ) {
	/**
	 * Function that generates params for holders on blog templates
	 */
	function cinerama_edge_get_blog_holder_params( $params ) {
		$params_list = array();
		
		$params_list['holder'] = 'edgtf-container';
		$params_list['inner']  = 'edgtf-container-inner clearfix';
		
		return $params_list;
	}
	
	add_filter( 'cinerama_edge_filter_blog_holder_params', 'cinerama_edge_get_blog_holder_params' );
}

if ( ! function_exists( 'cinerama_edge_blog_part_params' ) ) {
	function cinerama_edge_blog_part_params( $params ) {
		
		$part_params              = array();
		$part_params['title_tag'] = 'h3';
		$part_params['link_tag']  = 'h4';
		$part_params['quote_tag'] = 'h4';
		
		return array_merge( $params, $part_params );
	}
	
	add_filter( 'cinerama_edge_filter_blog_part_params', 'cinerama_edge_blog_part_params' );
}