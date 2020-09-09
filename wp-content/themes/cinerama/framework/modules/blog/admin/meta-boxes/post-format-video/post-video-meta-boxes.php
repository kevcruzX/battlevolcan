<?php

if ( ! function_exists( 'cinerama_edge_map_post_video_meta' ) ) {
	function cinerama_edge_map_post_video_meta() {
		$video_post_format_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'cinerama' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'cinerama' ),
				'description'   => esc_html__( 'Choose video type', 'cinerama' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'cinerama' ),
					'self'            => esc_html__( 'Self Hosted', 'cinerama' )
				)
			)
		);
		
		$edgtf_video_embedded_container = cinerama_edge_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'edgtf_video_embedded_container'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'cinerama' ),
				'description' => esc_html__( 'Enter Video URL', 'cinerama' ),
				'parent'      => $edgtf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'cinerama' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'cinerama' ),
				'parent'      => $edgtf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_video_type_meta' => 'self'
					)
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'cinerama' ),
				'description' => esc_html__( 'Enter video image', 'cinerama' ),
				'parent'      => $edgtf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_map_post_video_meta', 22 );
}