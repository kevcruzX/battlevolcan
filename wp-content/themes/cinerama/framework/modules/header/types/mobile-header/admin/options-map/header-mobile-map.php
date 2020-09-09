<?php

if ( ! function_exists( 'cinerama_edge_mobile_header_options_map' ) ) {
	function cinerama_edge_mobile_header_options_map() {
		
		cinerama_edge_add_admin_page(
			array(
				'slug'  => '_mobile_header',
				'title' => esc_html__( 'Mobile Header', 'cinerama' ),
				'icon'  => 'fa fa-mobile'
			)
		);
		
		$panel_mobile_header = cinerama_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Mobile Header', 'cinerama' ),
				'name'  => 'panel_mobile_header',
				'page'  => '_mobile_header'
			)
		);
		
		$mobile_header_group = cinerama_edge_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_group',
				'title'  => esc_html__( 'Mobile Header Styles', 'cinerama' )
			)
		);
		
		$mobile_header_row1 = cinerama_edge_add_admin_row(
			array(
				'parent' => $mobile_header_group,
				'name'   => 'mobile_header_row1'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_header_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Height', 'cinerama' ),
				'parent' => $mobile_header_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_header_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'cinerama' ),
				'parent' => $mobile_header_row1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_header_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'cinerama' ),
				'parent' => $mobile_header_row1
			)
		);
		
		$mobile_menu_group = cinerama_edge_add_admin_group(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_menu_group',
				'title'  => esc_html__( 'Mobile Menu Styles', 'cinerama' )
			)
		);
		
		$mobile_menu_row1 = cinerama_edge_add_admin_row(
			array(
				'parent' => $mobile_menu_group,
				'name'   => 'mobile_menu_row1'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_menu_background_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Background Color', 'cinerama' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_menu_border_bottom_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Border Bottom Color', 'cinerama' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_menu_separator_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Menu Item Separator Color', 'cinerama' ),
				'parent' => $mobile_menu_row1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'        => 'mobile_logo_height',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Header', 'cinerama' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 1024px', 'cinerama' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'        => 'mobile_logo_height_phones',
				'type'        => 'text',
				'label'       => esc_html__( 'Logo Height For Mobile Devices', 'cinerama' ),
				'description' => esc_html__( 'Define logo height for screen size smaller than 480px', 'cinerama' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		cinerama_edge_add_admin_section_title(
			array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_fonts_title',
				'title'  => esc_html__( 'Typography', 'cinerama' )
			)
		);
		
		$first_level_group = cinerama_edge_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'first_level_group',
				'title'       => esc_html__( '1st Level Menu', 'cinerama' ),
				'description' => esc_html__( 'Define styles for 1st level in Mobile Menu Navigation', 'cinerama' )
			)
		);
		
		$first_level_row1 = cinerama_edge_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'cinerama' ),
				'parent' => $first_level_row1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'cinerama' ),
				'parent' => $first_level_row1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'cinerama' ),
				'parent' => $first_level_row1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'cinerama' ),
				'parent' => $first_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$first_level_row2 = cinerama_edge_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'cinerama' ),
				'parent' => $first_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'    => 'mobile_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'cinerama' ),
				'parent'  => $first_level_row2,
				'options' => cinerama_edge_get_text_transform_array()
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'    => 'mobile_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'cinerama' ),
				'parent'  => $first_level_row2,
				'options' => cinerama_edge_get_font_style_array()
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'    => 'mobile_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'cinerama' ),
				'parent'  => $first_level_row2,
				'options' => cinerama_edge_get_font_weight_array()
			)
		);
		
		$first_level_row3 = cinerama_edge_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row3'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
				'default_value' => '',
				'parent'        => $first_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$second_level_group = cinerama_edge_add_admin_group(
			array(
				'parent'      => $panel_mobile_header,
				'name'        => 'second_level_group',
				'title'       => esc_html__( 'Dropdown Menu', 'cinerama' ),
				'description' => esc_html__( 'Define styles for drop down menu items in Mobile Menu Navigation', 'cinerama' )
			)
		);
		
		$second_level_row1 = cinerama_edge_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Text Color', 'cinerama' ),
				'parent' => $second_level_row1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_hover_color',
				'type'   => 'colorsimple',
				'label'  => esc_html__( 'Hover/Active Text Color', 'cinerama' ),
				'parent' => $second_level_row1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_google_fonts',
				'type'   => 'fontsimple',
				'label'  => esc_html__( 'Font Family', 'cinerama' ),
				'parent' => $second_level_row1
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_font_size',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Font Size', 'cinerama' ),
				'parent' => $second_level_row1,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$second_level_row2 = cinerama_edge_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_dropdown_text_line_height',
				'type'   => 'textsimple',
				'label'  => esc_html__( 'Line Height', 'cinerama' ),
				'parent' => $second_level_row2,
				'args'   => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_text_transform',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Text Transform', 'cinerama' ),
				'parent'  => $second_level_row2,
				'options' => cinerama_edge_get_text_transform_array()
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_style',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Style', 'cinerama' ),
				'parent'  => $second_level_row2,
				'options' => cinerama_edge_get_font_style_array()
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'    => 'mobile_dropdown_text_font_weight',
				'type'    => 'selectsimple',
				'label'   => esc_html__( 'Font Weight', 'cinerama' ),
				'parent'  => $second_level_row2,
				'options' => cinerama_edge_get_font_weight_array()
			)
		);
		
		$second_level_row3 = cinerama_edge_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row3'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'textsimple',
				'name'          => 'mobile_dropdown_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
				'default_value' => '',
				'parent'        => $second_level_row3,
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		cinerama_edge_add_admin_section_title(
			array(
				'name'   => 'mobile_opener_panel',
				'parent' => $panel_mobile_header,
				'title'  => esc_html__( 'Mobile Menu Opener', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'        => 'mobile_menu_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Mobile Navigation Title', 'cinerama' ),
				'description' => esc_html__( 'Enter title for mobile menu navigation', 'cinerama' ),
				'parent'      => $panel_mobile_header,
				'args'        => array(
					'col_width' => 3
				)
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'        => $panel_mobile_header,
				'type'          => 'select',
				'name'          => 'mobile_icon_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Mobile Navigation Icon Source', 'cinerama' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'cinerama' ),
				'options'       => cinerama_edge_get_icon_sources_array()
			)
		);

		$mobile_icon_pack_container = cinerama_edge_add_admin_container(
			array(
				'parent'          => $panel_mobile_header,
				'name'            => 'mobile_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'mobile_icon_icon_source' => 'icon_pack'
					)
				)
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'        => $mobile_icon_pack_container,
				'type'          => 'select',
				'name'          => 'mobile_icon_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Mobile Navigation Icon Pack', 'cinerama' ),
				'description'   => esc_html__( 'Choose icon pack for mobile navigation icon', 'cinerama' ),
				'options'       => cinerama_edge_icon_collections()->getIconCollectionsExclude( array( 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$mobile_icon_svg_path_container = cinerama_edge_add_admin_container(
			array(
				'parent'          => $panel_mobile_header,
				'name'            => 'mobile_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'mobile_icon_icon_source' => 'svg_path'
					)
				)
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'      => $mobile_icon_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'mobile_icon_svg_path',
				'label'       => esc_html__( 'Mobile Navigation Icon SVG Path', 'cinerama' ),
				'description' => esc_html__( 'Enter your mobile navigation icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'cinerama' ),
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_icon_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Color', 'cinerama' ),
				'parent' => $panel_mobile_header
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'   => 'mobile_icon_hover_color',
				'type'   => 'color',
				'label'  => esc_html__( 'Mobile Navigation Icon Hover Color', 'cinerama' ),
				'parent' => $panel_mobile_header
			)
		);
	}
	
	add_action( 'cinerama_edge_action_options_map', 'cinerama_edge_mobile_header_options_map', 5 );
}