<?php

if ( ! function_exists( 'cinerama_edge_like' ) ) {
	/**
	 * Returns CineramaEdgeClassLike instance
	 *
	 * @return CineramaEdgeClassLike
	 */
	function cinerama_edge_like() {
		return CineramaEdgeClassLike::get_instance();
	}
}

function cinerama_edge_get_like() {
	
	echo wp_kses( cinerama_edge_like()->add_like(), array(
		'span' => array(
			'class'       => true,
			'aria-hidden' => true,
			'style'       => true,
			'id'          => true
		),
		'i'    => array(
			'class' => true,
			'style' => true,
			'id'    => true
		),
		'a'    => array(
			'href'  	   => true,
			'class' 	   => true,
			'id'    	   => true,
			'title' 	   => true,
			'style'        => true,
			'data-post-id' => true
		),
		'input' => array(
			'type'  => true,
			'name'  => true,
			'id'    => true,
			'value' => true
		)
	) );
}