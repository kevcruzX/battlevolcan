<?php

if ( ! function_exists( 'cinerama_edge_map_post_link_meta' ) ) {
	function cinerama_edge_map_post_link_meta() {
		$link_post_format_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'cinerama' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'cinerama' ),
				'description' => esc_html__( 'Enter link', 'cinerama' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_map_post_link_meta', 24 );
}