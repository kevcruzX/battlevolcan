<?php

if ( ! function_exists( 'cinerama_edge_header_types_meta_boxes' ) ) {
	function cinerama_edge_header_types_meta_boxes() {
		$header_type_options = apply_filters( 'cinerama_edge_filter_header_type_meta_boxes', $header_type_options = array( '' => esc_html__( 'Default', 'cinerama' ) ) );
		
		return $header_type_options;
	}
}

if ( ! function_exists( 'cinerama_edge_get_hide_dep_for_header_behavior_meta_boxes' ) ) {
	function cinerama_edge_get_hide_dep_for_header_behavior_meta_boxes() {
		$hide_dep_options = apply_filters( 'cinerama_edge_filter_header_behavior_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

foreach ( glob( EDGE_FRAMEWORK_HEADER_ROOT_DIR . '/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

foreach ( glob( EDGE_FRAMEWORK_HEADER_TYPES_ROOT_DIR . '/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'cinerama_edge_map_header_meta' ) ) {
	function cinerama_edge_map_header_meta() {
		$header_type_meta_boxes              = cinerama_edge_header_types_meta_boxes();
		$header_behavior_meta_boxes_hide_dep = cinerama_edge_get_hide_dep_for_header_behavior_meta_boxes();
		
		$header_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'cinerama_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'header_meta' ),
				'title' => esc_html__( 'Header', 'cinerama' ),
				'name'  => 'header_meta'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_header_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Choose Header Type', 'cinerama' ),
				'description'   => esc_html__( 'Select header type layout', 'cinerama' ),
				'parent'        => $header_meta_box,
				'options'       => $header_type_meta_boxes
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_header_style_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'cinerama' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'cinerama' ),
				'parent'        => $header_meta_box,
				'options'       => array(
					''             => esc_html__( 'Default', 'cinerama' ),
					'light-header' => esc_html__( 'Light', 'cinerama' ),
					'dark-header'  => esc_html__( 'Dark', 'cinerama' )
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'parent'          => $header_meta_box,
				'type'            => 'select',
				'name'            => 'edgtf_header_behaviour_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Header Behaviour', 'cinerama' ),
				'description'     => esc_html__( 'Select the behaviour of header when you scroll down to page', 'cinerama' ),
				'options'         => array(
					''                                => esc_html__( 'Default', 'cinerama' ),
					'fixed-on-scroll'                 => esc_html__( 'Fixed on scroll', 'cinerama' ),
					'no-behavior'                     => esc_html__( 'No Behavior', 'cinerama' ),
					'sticky-header-on-scroll-up'      => esc_html__( 'Sticky on scroll up', 'cinerama' ),
					'sticky-header-on-scroll-down-up' => esc_html__( 'Sticky on scroll up/down', 'cinerama' )
				),
				'dependency' => array(
					'hide' => array(
						'edgtf_header_type_meta'  => $header_behavior_meta_boxes_hide_dep
					)
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'parent'        => $header_meta_box,
				'type'          => 'select',
				'name'          => 'edgtf_fixed_header_skin_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Fixed Header Skin', 'cinerama' ),
				'options'       => array(
					''     => esc_html__( 'Default', 'cinerama' ),
					'dark' => esc_html__( 'Dark', 'cinerama' )
				),
				'dependency'    => array(
					'show' => array(
						'edgtf_header_behaviour_meta' => 'fixed-on-scroll'
					)
				)
			)
		);
		
		//additional area
		do_action( 'cinerama_edge_action_additional_header_area_meta_boxes_map', $header_meta_box );
		
		//top area
		do_action( 'cinerama_edge_action_header_top_area_meta_boxes_map', $header_meta_box );
		
		//logo area
		do_action( 'cinerama_edge_action_header_logo_area_meta_boxes_map', $header_meta_box );
		
		//menu area
		do_action( 'cinerama_edge_action_header_menu_area_meta_boxes_map', $header_meta_box );
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_map_header_meta', 50 );
}