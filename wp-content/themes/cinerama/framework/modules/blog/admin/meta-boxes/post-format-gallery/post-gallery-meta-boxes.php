<?php

if ( ! function_exists( 'cinerama_edge_map_post_gallery_meta' ) ) {
	
	function cinerama_edge_map_post_gallery_meta() {
		$gallery_post_format_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'cinerama' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		cinerama_edge_add_multiple_images_field(
			array(
				'name'        => 'edgtf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'cinerama' ),
				'description' => esc_html__( 'Choose your gallery images', 'cinerama' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_map_post_gallery_meta', 21 );
}
