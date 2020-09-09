<?php

/*** Masonry Gallery Settings ***/

if ( ! function_exists( 'cinerama_edge_map_masonry_gallery_meta' ) ) {
	function cinerama_edge_map_masonry_gallery_meta( $post_meta_box ) {
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_blog_masonry_gallery_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry Gallery List - Dimensions for Fixed Proportion', 'cinerama' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in fixed proportion', 'cinerama' ),
				'default_value' => 'small',
				'parent'        => $post_meta_box,
				'options'       => array(
					'small'              => esc_html__( 'Small', 'cinerama' ),
					'large-width'        => esc_html__( 'Large Width', 'cinerama' ),
					'large-height'       => esc_html__( 'Large Height', 'cinerama' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'cinerama' )
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_blog_masonry_gallery_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry Gallery List - Dimensions for Original Proportion', 'cinerama' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry lists in original proportion', 'cinerama' ),
				'default_value' => 'default',
				'parent'        => $post_meta_box,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'cinerama' ),
					'large-width' => esc_html__( 'Large Width', 'cinerama' )
				)
			)
		);
	}
	
	add_action( 'cinerama_edge_action_blog_post_meta', 'cinerama_edge_map_masonry_gallery_meta' );
}
