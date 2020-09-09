<?php

if ( ! function_exists( 'cinerama_edge_get_hide_dep_for_header_logo_area_options' ) ) {
	function cinerama_edge_get_hide_dep_for_header_logo_area_options() {
		$hide_dep_options = apply_filters( 'cinerama_edge_filter_header_logo_area_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'cinerama_edge_header_logo_area_options_map' ) ) {
	function cinerama_edge_header_logo_area_options_map( $panel_header ) {
		$hide_dep_options = cinerama_edge_get_hide_dep_for_header_logo_area_options();
		
		$logo_area_container = cinerama_edge_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'logo_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		cinerama_edge_add_admin_section_title(
			array(
				'parent' => $logo_area_container,
				'name'   => 'logo_menu_area_title',
				'title'  => esc_html__( 'Logo Area', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__( 'Logo Area In Grid', 'cinerama' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'cinerama' )
			)
		);
		
		$logo_area_in_grid_container = cinerama_edge_add_admin_container(
			array(
				'parent'     => $logo_area_container,
				'dependency' => array(
					'hide' => array(
						'logo_area_in_grid' => 'no'
					)
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_container,
				'type'          => 'color',
				'name'          => 'logo_area_grid_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Color', 'cinerama' ),
				'description'   => esc_html__( 'Set grid background color for logo area', 'cinerama' ),
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_container,
				'type'          => 'text',
				'name'          => 'logo_area_grid_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Transparency', 'cinerama' ),
				'description'   => esc_html__( 'Set grid background transparency', 'cinerama' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $logo_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_in_grid_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Border', 'cinerama' ),
				'description'   => esc_html__( 'Set border on grid area', 'cinerama' )
			)
		);
		
		$logo_area_in_grid_border_container = cinerama_edge_add_admin_container(
			array(
				'parent'          => $logo_area_in_grid_container,
				'name'            => 'logo_area_in_grid_border_container',
				'dependency' => array(
					'hide' => array(
						'logo_area_in_grid_border'  => 'no'
					)
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'      => $logo_area_in_grid_border_container,
				'type'        => 'color',
				'name'        => 'logo_area_in_grid_border_color',
				'label'       => esc_html__( 'Border Color', 'cinerama' ),
				'description' => esc_html__( 'Set border color for grid area', 'cinerama' ),
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'      => $logo_area_container,
				'type'        => 'color',
				'name'        => 'logo_area_background_color',
				'label'       => esc_html__( 'Background Color', 'cinerama' ),
				'description' => esc_html__( 'Set background color for logo area', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'text',
				'name'          => 'logo_area_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'cinerama' ),
				'description'   => esc_html__( 'Set background transparency for logo area', 'cinerama' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $logo_area_container,
				'type'          => 'yesno',
				'name'          => 'logo_area_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Logo Area Border', 'cinerama' ),
				'description'   => esc_html__( 'Set border on logo area', 'cinerama' )
			)
		);
		
		$logo_area_border_container = cinerama_edge_add_admin_container(
			array(
				'parent'          => $logo_area_container,
				'name'            => 'logo_area_border_container',
				'dependency' => array(
					'hide' => array(
						'logo_area_border'  => 'no'
					)
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'color',
				'name'          => 'logo_area_border_color',
				'label'         => esc_html__( 'Border Color', 'cinerama' ),
				'description'   => esc_html__( 'Set border color for logo area', 'cinerama' ),
				'parent'        => $logo_area_border_container
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'logo_area_height',
				'label'         => esc_html__( 'Height', 'cinerama' ),
				'description'   => esc_html__( 'Enter logo area height (default is 90px)', 'cinerama' ),
				'parent'        => $logo_area_container,
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		do_action( 'cinerama_edge_header_logo_area_additional_options', $logo_area_container );
	}
	
	add_action( 'cinerama_edge_action_header_logo_area_options_map', 'cinerama_edge_header_logo_area_options_map', 10, 1 );
}