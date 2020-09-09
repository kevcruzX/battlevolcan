<?php

if ( ! function_exists( 'cinerama_edge_map_sidebar_meta' ) ) {
	function cinerama_edge_map_sidebar_meta() {
		$edgtf_sidebar_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'cinerama_edge_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'cinerama' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'cinerama' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'cinerama' ),
				'parent'      => $edgtf_sidebar_meta_box,
                'options'       => cinerama_edge_get_custom_sidebars_options( true )
			)
		);
		
		$edgtf_custom_sidebars = cinerama_edge_get_custom_sidebars();
		if ( count( $edgtf_custom_sidebars ) > 0 ) {
			cinerama_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'cinerama' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'cinerama' ),
					'parent'      => $edgtf_sidebar_meta_box,
					'options'     => $edgtf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_map_sidebar_meta', 31 );
}