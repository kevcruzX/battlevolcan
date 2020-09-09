<?php

if ( ! function_exists( 'cinerama_edge_logo_meta_box_map' ) ) {
	function cinerama_edge_logo_meta_box_map() {
		
		$logo_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'cinerama_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'cinerama' ),
				'name'  => 'logo_meta'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'cinerama' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'cinerama' ),
				'parent'      => $logo_meta_box
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'cinerama' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'cinerama' ),
				'parent'      => $logo_meta_box
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'cinerama' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'cinerama' ),
				'parent'      => $logo_meta_box
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'cinerama' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'cinerama' ),
				'parent'      => $logo_meta_box
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'cinerama' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'cinerama' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_logo_meta_box_map', 47 );
}