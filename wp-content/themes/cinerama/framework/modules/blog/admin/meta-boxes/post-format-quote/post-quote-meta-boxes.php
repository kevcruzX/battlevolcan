<?php

if ( ! function_exists( 'cinerama_edge_map_post_quote_meta' ) ) {
	function cinerama_edge_map_post_quote_meta() {
		$quote_post_format_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'cinerama' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'cinerama' ),
				'description' => esc_html__( 'Enter Quote text', 'cinerama' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'cinerama' ),
				'description' => esc_html__( 'Enter Quote author', 'cinerama' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_map_post_quote_meta', 25 );
}