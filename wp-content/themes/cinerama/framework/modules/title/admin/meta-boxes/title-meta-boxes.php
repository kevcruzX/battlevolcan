<?php

if ( ! function_exists( 'cinerama_edge_get_title_types_meta_boxes' ) ) {
	function cinerama_edge_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'cinerama_edge_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'cinerama' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'cinerama_edge_map_title_meta' ) ) {
	function cinerama_edge_map_title_meta() {
		$title_type_meta_boxes = cinerama_edge_get_title_types_meta_boxes();
		
		$title_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'cinerama_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'cinerama' ),
				'name'  => 'title_meta'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'cinerama' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'cinerama' ),
				'parent'        => $title_meta_box,
				'options'       => cinerama_edge_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = cinerama_edge_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'edgtf_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'edgtf_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				cinerama_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'cinerama' ),
						'description'   => esc_html__( 'Choose title type', 'cinerama' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				cinerama_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'cinerama' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'cinerama' ),
						'options'       => cinerama_edge_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				cinerama_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'cinerama' ),
						'description' => esc_html__( 'Set a height for Title Area', 'cinerama' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				cinerama_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'cinerama' ),
						'description' => esc_html__( 'Choose a background color for title area', 'cinerama' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				cinerama_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'cinerama' ),
						'description' => esc_html__( 'Choose an Image for title area', 'cinerama' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				cinerama_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'cinerama' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'cinerama' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'cinerama' ),
							'hide'                => esc_html__( 'Hide Image', 'cinerama' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'cinerama' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'cinerama' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'cinerama' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'cinerama' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'cinerama' )
						)
					)
				);
				
				cinerama_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'cinerama' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'cinerama' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'cinerama' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'cinerama' ),
							'window-top'    => esc_html__( 'From Window Top', 'cinerama' )
						)
					)
				);
				
				cinerama_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'cinerama' ),
						'options'       => cinerama_edge_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				cinerama_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'cinerama' ),
						'description' => esc_html__( 'Choose a color for title text', 'cinerama' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				cinerama_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'cinerama' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'cinerama' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				cinerama_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'cinerama' ),
						'options'       => cinerama_edge_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				cinerama_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'cinerama' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'cinerama' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'cinerama_edge_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_map_title_meta', 60 );
}