<?php

if ( ! function_exists( 'cinerama_edge_sidebar_options_map' ) ) {
	function cinerama_edge_sidebar_options_map() {
		
		cinerama_edge_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'cinerama' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = cinerama_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'cinerama' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		cinerama_edge_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'cinerama' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'cinerama' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => cinerama_edge_get_custom_sidebars_options()
		) );
		
		$cinerama_custom_sidebars = cinerama_edge_get_custom_sidebars();
		if ( count( $cinerama_custom_sidebars ) > 0 ) {
			cinerama_edge_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'cinerama' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'cinerama' ),
				'parent'      => $sidebar_panel,
				'options'     => $cinerama_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'cinerama_edge_action_options_map', 'cinerama_edge_sidebar_options_map', 9 );
}