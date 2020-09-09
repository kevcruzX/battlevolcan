<?php

if ( ! function_exists( 'cinerama_edge_get_hide_dep_for_header_standard_options' ) ) {
	function cinerama_edge_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'cinerama_edge_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'cinerama_edge_header_standard_map' ) ) {
	function cinerama_edge_header_standard_map( $parent ) {
		$hide_dep_options = cinerama_edge_get_hide_dep_for_header_standard_options();
		
		cinerama_edge_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'cinerama' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'cinerama' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'cinerama' ),
					'left'   => esc_html__( 'Left', 'cinerama' ),
					'center' => esc_html__( 'Center', 'cinerama' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'cinerama_edge_action_additional_header_menu_area_options_map', 'cinerama_edge_header_standard_map' );
}