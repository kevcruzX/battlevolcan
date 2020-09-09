<?php

if ( ! function_exists( 'cinerama_edge_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function cinerama_edge_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'cinerama_edge_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'cinerama_edge_header_standard_meta_map' ) ) {
	function cinerama_edge_header_standard_meta_map( $parent ) {
		$hide_dep_options = cinerama_edge_get_hide_dep_for_header_standard_meta_boxes();
		
		cinerama_edge_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'edgtf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'cinerama' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'cinerama' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'cinerama' ),
					'left'   => esc_html__( 'Left', 'cinerama' ),
					'right'  => esc_html__( 'Right', 'cinerama' ),
					'center' => esc_html__( 'Center', 'cinerama' )
				),
				'dependency' => array(
					'hide' => array(
						'edgtf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'cinerama_edge_action_additional_header_area_meta_boxes_map', 'cinerama_edge_header_standard_meta_map' );
}