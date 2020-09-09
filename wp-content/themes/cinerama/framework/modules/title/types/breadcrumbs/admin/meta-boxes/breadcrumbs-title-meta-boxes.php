<?php

if ( ! function_exists( 'cinerama_edge_breadcrumbs_title_type_options_meta_boxes' ) ) {
	function cinerama_edge_breadcrumbs_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_breadcrumbs_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Breadcrumbs Color', 'cinerama' ),
				'description' => esc_html__( 'Choose a color for breadcrumbs text', 'cinerama' ),
				'parent'      => $show_title_area_meta_container
			)
		);
	}
	
	add_action( 'cinerama_edge_action_additional_title_area_meta_boxes', 'cinerama_edge_breadcrumbs_title_type_options_meta_boxes' );
}