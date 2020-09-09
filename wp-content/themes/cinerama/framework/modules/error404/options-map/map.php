<?php

if ( ! function_exists( 'cinerama_edge_error_404_options_map' ) ) {
	function cinerama_edge_error_404_options_map() {
		
		cinerama_edge_add_admin_page(
			array(
				'slug'  => '__404_error_page',
				'title' => esc_html__( '404 Error Page', 'cinerama' ),
				'icon'  => 'fa fa-exclamation-triangle'
			)
		);
		
		$panel_404_header = cinerama_edge_add_admin_panel(
			array(
				'page'  => '__404_error_page',
				'name'  => 'panel_404_header',
				'title' => esc_html__( 'Header', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'      => $panel_404_header,
				'type'        => 'color',
				'name'        => '404_menu_area_background_color_header',
				'label'       => esc_html__( 'Background Color', 'cinerama' ),
				'description' => esc_html__( 'Choose a background color for header area', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $panel_404_header,
				'type'          => 'text',
				'name'          => '404_menu_area_background_transparency_header',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'cinerama' ),
				'description'   => esc_html__( 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'cinerama' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'      => $panel_404_header,
				'type'        => 'color',
				'name'        => '404_menu_area_border_color_header',
				'label'       => esc_html__( 'Border Color', 'cinerama' ),
				'description' => esc_html__( 'Choose a border bottom color for header area', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $panel_404_header,
				'type'          => 'select',
				'name'          => '404_header_style',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'cinerama' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'cinerama' ),
				'options'       => array(
					''             => esc_html__( 'Default', 'cinerama' ),
					'light-header' => esc_html__( 'Light', 'cinerama' ),
					'dark-header'  => esc_html__( 'Dark', 'cinerama' )
				)
			)
		);
		
		$panel_404_options = cinerama_edge_add_admin_panel(
			array(
				'page'  => '__404_error_page',
				'name'  => 'panel_404_options',
				'title' => esc_html__( '404 Page Options', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent' => $panel_404_options,
				'type'   => 'color',
				'name'   => '404_page_background_color',
				'label'  => esc_html__( 'Background Color', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_background_image',
				'label'       => esc_html__( 'Background Image', 'cinerama' ),
				'description' => esc_html__( 'Choose a background image for 404 page', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_background_pattern_image',
				'label'       => esc_html__( 'Pattern Background Image', 'cinerama' ),
				'description' => esc_html__( 'Choose a pattern image for 404 page', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_title_image',
				'label'       => esc_html__( 'Title Image', 'cinerama' ),
				'description' => esc_html__( 'Choose a background image for displaying above 404 page Title', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_title',
				'default_value' => '',
				'label'         => esc_html__( 'Title', 'cinerama' ),
				'description'   => esc_html__( 'Enter title for 404 page. Default label is "404".', 'cinerama' )
			)
		);
		
		$first_level_group = cinerama_edge_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'first_level_group',
				'title'       => esc_html__( 'Title Style', 'cinerama' ),
				'description' => esc_html__( 'Define styles for 404 page title', 'cinerama' )
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
				'parent' => $first_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_title_color',
				'label'  => esc_html__( 'Text Color', 'cinerama' ),
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_title_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'cinerama' ),
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_title_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_title_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$first_level_row2 = cinerama_edge_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2',
				'next'   => true
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'cinerama' ),
				'options'       => cinerama_edge_get_font_style_array()
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'cinerama' ),
				'options'       => cinerama_edge_get_font_weight_array()
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_title_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'cinerama' ),
				'options'       => cinerama_edge_get_text_transform_array()
			)
		);

        $first_level_group_responsive = cinerama_edge_add_admin_group(
            array(
                'parent'      => $panel_404_options,
                'name'        => 'first_level_group_responsive',
                'title'       => esc_html__( 'Title Style Responsive', 'cinerama' ),
                'description' => esc_html__( 'Define responsive styles for 404 page title (under 680px)', 'cinerama' )
            )
        );

        $first_level_row3 = cinerama_edge_add_admin_row(
            array(
                'parent' => $first_level_group_responsive,
                'name'   => 'first_level_row3'
            )
        );

        cinerama_edge_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_title_responsive_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'cinerama' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        cinerama_edge_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_title_responsive_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'cinerama' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        cinerama_edge_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_title_responsive_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_subtitle',
				'default_value' => '',
				'label'         => esc_html__( 'Subtitle', 'cinerama' ),
				'description'   => esc_html__( 'Enter subtitle for 404 page. Default label is "PAGE CAN NOT BE FOUND".', 'cinerama' )
			)
		);
		
		$second_level_group = cinerama_edge_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'second_level_group',
				'title'       => esc_html__( 'Subtitle Style', 'cinerama' ),
				'description' => esc_html__( 'Define styles for 404 page subtitle', 'cinerama' )
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
				'parent' => $second_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_subtitle_color',
				'label'  => esc_html__( 'Text Color', 'cinerama' ),
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_subtitle_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'cinerama' ),
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$second_level_row2 = cinerama_edge_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2',
				'next'   => true
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'cinerama' ),
				'options'       => cinerama_edge_get_font_style_array()
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'cinerama' ),
				'options'       => cinerama_edge_get_font_weight_array()
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'cinerama' ),
				'options'       => cinerama_edge_get_text_transform_array()
			)
		);

        $second_level_group_responsive = cinerama_edge_add_admin_group(
            array(
                'parent'      => $panel_404_options,
                'name'        => 'second_level_group_responsive',
                'title'       => esc_html__( 'Subtitle Style Responsive', 'cinerama' ),
                'description' => esc_html__( 'Define responsive styles for 404 page subtitle (under 680px)', 'cinerama' )
            )
        );

        $second_level_row3 = cinerama_edge_add_admin_row(
            array(
                'parent' => $second_level_group_responsive,
                'name'   => 'second_level_row3'
            )
        );

        cinerama_edge_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_subtitle_responsive_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'cinerama' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        cinerama_edge_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_subtitle_responsive_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'cinerama' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        cinerama_edge_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_subtitle_responsive_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        cinerama_edge_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_tagline',
				'default_value' => '',
				'label'         => esc_html__( 'Tagline', 'cinerama' ),
				'description'   => esc_html__( 'Enter tagline for 404 page. Default label is "ERROR PAGE".', 'cinerama' )
			)
		);

		$third_level_group = cinerama_edge_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'third_level_group',
				'title'       => esc_html__( 'Tagline Style', 'cinerama' ),
				'description' => esc_html__( 'Define styles for 404 page tagline', 'cinerama' )
			)
		);

		$third_level_row1 = cinerama_edge_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => 'third_level_row1'
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent' => $third_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_tagline_color',
				'label'  => esc_html__( 'Text Color', 'cinerama' ),
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_tagline_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'cinerama' ),
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_tagline_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_tagline_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		$third_level_row2 = cinerama_edge_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => 'third_level_row2',
				'next'   => true
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_tagline_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'cinerama' ),
				'options'       => cinerama_edge_get_font_style_array()
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_tagline_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'cinerama' ),
				'options'       => cinerama_edge_get_font_weight_array()
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_tagline_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_tagline_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'cinerama' ),
				'options'       => cinerama_edge_get_text_transform_array()
			)
		);

        $third_level_group_responsive = cinerama_edge_add_admin_group(
            array(
                'parent'      => $panel_404_options,
                'name'        => 'third_level_group_responsive',
                'title'       => esc_html__( 'Tagline Style Responsive', 'cinerama' ),
                'description' => esc_html__( 'Define responsive styles for 404 page tagline (under 680px)', 'cinerama' )
            )
        );

        $third_level_row3 = cinerama_edge_add_admin_row(
            array(
                'parent' => $third_level_group_responsive,
                'name'   => 'third_level_row3'
            )
        );

        cinerama_edge_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_tagline_responsive_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'cinerama' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        cinerama_edge_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_tagline_responsive_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'cinerama' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        cinerama_edge_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_tagline_responsive_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

		cinerama_edge_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_text',
				'default_value' => '',
				'label'         => esc_html__( 'Text', 'cinerama' ),
				'description'   => esc_html__( 'Enter text for 404 page.', 'cinerama' )
			)
		);
		
		$forth_level_group = cinerama_edge_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => '$forth_level_group',
				'title'       => esc_html__( 'Text Style', 'cinerama' ),
				'description' => esc_html__( 'Define styles for 404 page text', 'cinerama' )
			)
		);
		
		$forth_level_row1 = cinerama_edge_add_admin_row(
			array(
				'parent' => $forth_level_group,
				'name'   => '$forth_level_row1'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent' => $forth_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_text_color',
				'label'  => esc_html__( 'Text Color', 'cinerama' ),
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $forth_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_text_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'cinerama' ),
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $forth_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_text_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $forth_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_text_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$forth_level_row2 = cinerama_edge_add_admin_row(
			array(
				'parent' => $forth_level_group,
				'name'   => '$forth_level_row2',
				'next'   => true
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $forth_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'cinerama' ),
				'options'       => cinerama_edge_get_font_style_array()
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $forth_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'cinerama' ),
				'options'       => cinerama_edge_get_font_weight_array()
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $forth_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_text_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $forth_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'cinerama' ),
				'options'       => cinerama_edge_get_text_transform_array()
			)
		);

        $forth_level_group_responsive = cinerama_edge_add_admin_group(
            array(
                'parent'      => $panel_404_options,
                'name'        => 'forth_level_group_responsive',
                'title'       => esc_html__( 'Text Style Responsive', 'cinerama' ),
                'description' => esc_html__( 'Define responsive styles for 404 page text (under 680px)', 'cinerama' )
            )
        );

        $forth_level_row3 = cinerama_edge_add_admin_row(
            array(
                'parent' => $forth_level_group_responsive,
                'name'   => 'forth_level_row3'
            )
        );

        cinerama_edge_add_admin_field(
            array(
                'parent'        => $forth_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_text_responsive_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'cinerama' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        cinerama_edge_add_admin_field(
            array(
                'parent'        => $forth_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_text_responsive_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'cinerama' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        cinerama_edge_add_admin_field(
            array(
                'parent'        => $forth_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_text_responsive_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'cinerama' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );
		
		cinerama_edge_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'text',
				'name'        => '404_back_to_home',
				'label'       => esc_html__( 'Back to Homepage Button Label', 'cinerama' ),
				'description' => esc_html__( 'Enter label for "Back to homepage" button', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'select',
				'name'          => '404_button_style',
				'default_value' => '',
				'label'         => esc_html__( 'Button Skin', 'cinerama' ),
				'description'   => esc_html__( 'Choose a style to make Back to Homepage button in that predefined style', 'cinerama' ),
				'options'       => array(
					''            => esc_html__( 'Default', 'cinerama' ),
					'light-style' => esc_html__( 'Light', 'cinerama' )
				)
			)
		);
	}
	
	add_action( 'cinerama_edge_action_options_map', 'cinerama_edge_error_404_options_map', 19 );
}