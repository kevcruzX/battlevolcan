<?php

if ( ! function_exists( 'cinerama_edge_footer_options_map' ) ) {
	function cinerama_edge_footer_options_map() {

		cinerama_edge_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'cinerama' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = cinerama_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'cinerama' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'cinerama' ),
				'parent'        => $footer_panel
			)
		);

        cinerama_edge_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'cinerama' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'cinerama' ),
                'parent'        => $footer_panel,
            )
        );

		cinerama_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'cinerama' ),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_top_container = cinerama_edge_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'cinerama' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'cinerama' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'cinerama' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'cinerama' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'cinerama' ),
					'left'   => esc_html__( 'Left', 'cinerama' ),
					'center' => esc_html__( 'Center', 'cinerama' ),
					'right'  => esc_html__( 'Right', 'cinerama' )
				),
				'parent'        => $show_footer_top_container,
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'cinerama' ),
				'description' => esc_html__( 'Set background color for top footer area', 'cinerama' ),
				'parent'      => $show_footer_top_container
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'cinerama' ),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_bottom_container = cinerama_edge_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'cinerama' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'cinerama' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'cinerama' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'cinerama' ),
				'parent'      => $show_footer_bottom_container
			)
		);
	}

	add_action( 'cinerama_edge_action_options_map', 'cinerama_edge_footer_options_map', 11 );
}