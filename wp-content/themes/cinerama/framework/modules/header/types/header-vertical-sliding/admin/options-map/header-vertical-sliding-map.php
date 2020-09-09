<?php

if ( ! function_exists( 'cinerama_edge_get_hide_dep_for_header_vertical_sliding_options' ) ) {
	function cinerama_edge_get_hide_dep_for_header_vertical_sliding_options() {
		$hide_dep_options = apply_filters( 'cinerama_edge_filter_header_vertical_sliding_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'cinerama_edge_header_vertical_sliding_options_map' ) ) {
	function cinerama_edge_header_vertical_sliding_options_map( $panel_header ) {
		$hide_dep_options = cinerama_edge_get_hide_dep_for_header_vertical_sliding_options();
		
		$vertical_sliding_container = cinerama_edge_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'vertical_sliding_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		cinerama_edge_add_admin_section_title(
			array(
				'parent' => $vertical_sliding_container,
				'name'   => 'vertical_sliding_opener_style',
				'title'  => esc_html__( 'Vertical Sliding Opener Style', 'cinerama' )
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'        => $vertical_sliding_container,
				'type'          => 'select',
				'name'          => 'vertical_sliding_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Vertical Sliding Icon Source', 'cinerama' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'cinerama' ),
				'options'       => cinerama_edge_get_icon_sources_array()
			)
		);

		$vertical_sliding_icon_pack_container = cinerama_edge_add_admin_container(
			array(
				'parent'          => $vertical_sliding_container,
				'name'            => 'vertical_sliding_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'vertical_sliding_icon_source' => 'icon_pack'
					)
				)
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'        => $vertical_sliding_icon_pack_container,
				'type'          => 'select',
				'name'          => 'vertical_sliding_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Vertical Sliding Icon Pack', 'cinerama' ),
				'description'   => esc_html__( 'Choose icon pack for vertical sliding header icon', 'cinerama' ),
				'options'       => cinerama_edge_icon_collections()->getIconCollectionsExclude( array( 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$vertical_sliding_icon_svg_path_container = cinerama_edge_add_admin_container(
			array(
				'parent'          => $vertical_sliding_container,
				'name'            => 'vertical_sliding_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'vertical_sliding_icon_source' => 'svg_path'
					)
				)
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'      => $vertical_sliding_icon_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'vertical_sliding_icon_svg_path',
				'label'       => esc_html__( 'Vertical Sliding Icon SVG Path', 'cinerama' ),
				'description' => esc_html__( 'Enter your vertical sliding icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'cinerama' ),
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'      => $vertical_sliding_icon_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'vertical_sliding_close_icon_svg_path',
				'label'       => esc_html__( 'Vertical Sliding Close Icon SVG Path', 'cinerama' ),
				'description' => esc_html__( 'Enter your vertical sliding close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'cinerama' ),
			)
		);

		$vertical_sliding_icon_style_group = cinerama_edge_add_admin_group(
			array(
				'parent'      => $vertical_sliding_container,
				'name'        => 'vertical_sliding_icon_style_group',
				'title'       => esc_html__( 'Vertical Sliding Icon Style', 'cinerama' ),
				'description' => esc_html__( 'Define styles for vetical sliding icon', 'cinerama' )
			)
		);
		
		$vertical_sliding_icon_colors_row = cinerama_edge_add_admin_row(
			array(
				'parent' => $vertical_sliding_icon_style_group,
				'name'   => 'vertical_sliding_icon_colors_row'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent' => $vertical_sliding_icon_colors_row,
				'type'   => 'colorsimple',
				'name'   => 'vertical_sliding_icon_color',
				'label'  => esc_html__( 'Color', 'cinerama' ),
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent' => $vertical_sliding_icon_colors_row,
				'type'   => 'colorsimple',
				'name'   => 'vertical_sliding_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'cinerama' ),
			)
		);
		
		do_action( 'cinerama_edge_header_vertical_sliding_additional_options', $panel_header );
	}
	
	add_action( 'cinerama_edge_action_additional_header_menu_area_options_map', 'cinerama_edge_header_vertical_sliding_options_map' );
}

if ( ! function_exists( 'cinerama_edge_header_vertical_navigation_options_map' ) ) {
	function cinerama_edge_header_vertical_navigation_options_map($panel_header) {
		$hide_dep_options = cinerama_edge_get_hide_dep_for_header_vertical_sliding_options();
		
		$panel_vertical_main_menu = cinerama_edge_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'vertical_sliding_main_menu_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		$drop_down_group = cinerama_edge_add_admin_group(
			array(
				'parent'      => $panel_vertical_main_menu,
				'name'        => 'vertical_drop_down_group',
				'title'       => esc_html__( 'Main Dropdown Menu', 'cinerama' ),
				'description' => esc_html__( 'Set a style for dropdown menu', 'cinerama' )
			)
		);
		
		$vertical_drop_down_row1 = cinerama_edge_add_admin_row(
			array(
				'parent' => $drop_down_group,
				'name'   => 'qodef_drop_down_row1',
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'vertical_menu_top_margin',
				'default_value' => '',
				'label'         => esc_html__( 'Top Margin', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				),
				'parent'        => $vertical_drop_down_row1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'vertical_menu_bottom_margin',
				'default_value' => '',
				'label'         => esc_html__( 'Bottom Margin', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				),
				'parent'        => $vertical_drop_down_row1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'vertical_menu_dropdown_opening',
				'default_value' => 'below',
				'label'         => esc_html__( 'Submenu Opening', 'cinerama' ),
				'options'		=> array(
					'below' => esc_html__('Below', 'cinerama'),
					'side' => esc_html__('On Side', 'cinerama'),
				),
				'parent'        => $panel_vertical_main_menu
			)
		);
		
		$group_vertical_first_level = cinerama_edge_add_admin_group(
			array(
				'name'        => 'group_vertical_first_level',
				'title'       => esc_html__( '1st level', 'cinerama' ),
				'description' => esc_html__( 'Define styles for 1st level menu', 'cinerama' ),
				'parent'      => $panel_vertical_main_menu
			)
		);
		
		$row_vertical_first_level_1 = cinerama_edge_add_admin_row(
			array(
				'name'   => 'row_vertical_first_level_1',
				'parent' => $group_vertical_first_level
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'vertical_menu_1st_color',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'cinerama' ),
				'parent'        => $row_vertical_first_level_1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'vertical_menu_1st_hover_color',
				'default_value' => '',
				'label'         => esc_html__( 'Hover/Active Color', 'cinerama' ),
				'parent'        => $row_vertical_first_level_1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'vertical_menu_1st_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				),
				'parent'        => $row_vertical_first_level_1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'vertical_menu_1st_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				),
				'parent'        => $row_vertical_first_level_1
			)
		);
		
		$row_vertical_first_level_2 = cinerama_edge_add_admin_row(
			array(
				'name'   => 'row_vertical_first_level_2',
				'parent' => $group_vertical_first_level,
				'next'   => true
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'vertical_menu_1st_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'cinerama' ),
				'options'       => cinerama_edge_get_text_transform_array(),
				'parent'        => $row_vertical_first_level_2
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'fontsimple',
				'name'          => 'vertical_menu_1st_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'cinerama' ),
				'parent'        => $row_vertical_first_level_2
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'vertical_menu_1st_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'cinerama' ),
				'options'       => cinerama_edge_get_font_style_array(),
				'parent'        => $row_vertical_first_level_2
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'vertical_menu_1st_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'cinerama' ),
				'options'       => cinerama_edge_get_font_weight_array(),
				'parent'        => $row_vertical_first_level_2
			)
		);
		
		$row_vertical_first_level_3 = cinerama_edge_add_admin_row(
			array(
				'name'   => 'row_vertical_first_level_3',
				'parent' => $group_vertical_first_level,
				'next'   => true
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'vertical_menu_1st_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				),
				'parent'        => $row_vertical_first_level_3
			)
		);
		
		$group_vertical_second_level = cinerama_edge_add_admin_group(
			array(
				'name'        => 'group_vertical_second_level',
				'title'       => esc_html__( '2nd level', 'cinerama' ),
				'description' => esc_html__( 'Define styles for 2nd level menu', 'cinerama' ),
				'parent'      => $panel_vertical_main_menu
			)
		);
		
		$row_vertical_second_level_1 = cinerama_edge_add_admin_row(
			array(
				'name'   => 'row_vertical_second_level_1',
				'parent' => $group_vertical_second_level
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'vertical_menu_2nd_color',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'cinerama' ),
				'parent'        => $row_vertical_second_level_1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'vertical_menu_2nd_hover_color',
				'default_value' => '',
				'label'         => esc_html__( 'Hover/Active Color', 'cinerama' ),
				'parent'        => $row_vertical_second_level_1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'vertical_menu_2nd_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				),
				'parent'        => $row_vertical_second_level_1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'vertical_menu_2nd_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				),
				'parent'        => $row_vertical_second_level_1
			)
		);
		
		$row_vertical_second_level_2 = cinerama_edge_add_admin_row(
			array(
				'name'   => 'row_vertical_second_level_2',
				'parent' => $group_vertical_second_level,
				'next'   => true
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'vertical_menu_2nd_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'cinerama' ),
				'options'       => cinerama_edge_get_text_transform_array(),
				'parent'        => $row_vertical_second_level_2
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'fontsimple',
				'name'          => 'vertical_menu_2nd_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'cinerama' ),
				'parent'        => $row_vertical_second_level_2
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'vertical_menu_2nd_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'cinerama' ),
				'options'       => cinerama_edge_get_font_style_array(),
				'parent'        => $row_vertical_second_level_2
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'vertical_menu_2nd_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'cinerama' ),
				'options'       => cinerama_edge_get_font_weight_array(),
				'parent'        => $row_vertical_second_level_2
			)
		);
		
		$row_vertical_second_level_3 = cinerama_edge_add_admin_row(
			array(
				'name'   => 'row_vertical_second_level_3',
				'parent' => $group_vertical_second_level,
				'next'   => true
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'vertical_menu_2nd_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				),
				'parent'        => $row_vertical_second_level_3
			)
		);
		
		$group_vertical_third_level = cinerama_edge_add_admin_group(
			array(
				'name'        => 'group_vertical_third_level',
				'title'       => esc_html__( '3rd level', 'cinerama' ),
				'description' => esc_html__( 'Define styles for 3rd level menu', 'cinerama' ),
				'parent'      => $panel_vertical_main_menu
			)
		);
		
		$row_vertical_third_level_1 = cinerama_edge_add_admin_row(
			array(
				'name'   => 'row_vertical_third_level_1',
				'parent' => $group_vertical_third_level
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'vertical_menu_3rd_color',
				'default_value' => '',
				'label'         => esc_html__( 'Text Color', 'cinerama' ),
				'parent'        => $row_vertical_third_level_1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'colorsimple',
				'name'          => 'vertical_menu_3rd_hover_color',
				'default_value' => '',
				'label'         => esc_html__( 'Hover/Active Color', 'cinerama' ),
				'parent'        => $row_vertical_third_level_1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'vertical_menu_3rd_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				),
				'parent'        => $row_vertical_third_level_1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'vertical_menu_3rd_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				),
				'parent'        => $row_vertical_third_level_1
			)
		);
		
		$row_vertical_third_level_2 = cinerama_edge_add_admin_row(
			array(
				'name'   => 'row_vertical_third_level_2',
				'parent' => $group_vertical_third_level,
				'next'   => true
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'vertical_menu_3rd_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'cinerama' ),
				'options'       => cinerama_edge_get_text_transform_array(),
				'parent'        => $row_vertical_third_level_2
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'fontsimple',
				'name'          => 'vertical_menu_3rd_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'cinerama' ),
				'parent'        => $row_vertical_third_level_2
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'vertical_menu_3rd_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'cinerama' ),
				'options'       => cinerama_edge_get_font_style_array(),
				'parent'        => $row_vertical_third_level_2
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'selectblanksimple',
				'name'          => 'vertical_menu_3rd_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'cinerama' ),
				'options'       => cinerama_edge_get_font_weight_array(),
				'parent'        => $row_vertical_third_level_2
			)
		);
		
		$row_vertical_third_level_3 = cinerama_edge_add_admin_row(
			array(
				'name'   => 'row_vertical_third_level_3',
				'parent' => $group_vertical_third_level,
				'next'   => true
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'vertical_menu_3rd_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				),
				'parent'        => $row_vertical_third_level_3
			)
		);
	}
	
	add_action( 'cinerama_edge_action_additional_header_menu_area_options_map', 'cinerama_edge_header_vertical_navigation_options_map' );
}