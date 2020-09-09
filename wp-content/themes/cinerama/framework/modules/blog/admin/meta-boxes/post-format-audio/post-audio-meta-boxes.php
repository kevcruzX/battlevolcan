<?php

if ( ! function_exists( 'cinerama_edge_map_post_audio_meta' ) ) {
	function cinerama_edge_map_post_audio_meta() {
		$audio_post_format_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'cinerama' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'cinerama' ),
				'description'   => esc_html__( 'Choose audio type', 'cinerama' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'cinerama' ),
					'self'            => esc_html__( 'Self Hosted', 'cinerama' )
				)
			)
		);
		
		$edgtf_audio_embedded_container = cinerama_edge_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'edgtf_audio_embedded_container'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'cinerama' ),
				'description' => esc_html__( 'Enter audio URL', 'cinerama' ),
				'parent'      => $edgtf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'cinerama' ),
				'description' => esc_html__( 'Enter audio link', 'cinerama' ),
				'parent'      => $edgtf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_map_post_audio_meta', 23 );
}