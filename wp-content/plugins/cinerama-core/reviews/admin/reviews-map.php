<?php

if ( ! function_exists( 'cinerama_core_reviews_map' ) ) {
	function cinerama_core_reviews_map() {
		
		$reviews_panel = cinerama_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Reviews', 'cinerama-core' ),
				'name'  => 'panel_reviews',
				'page'  => '_page_page'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'text',
				'name'        => 'reviews_section_title',
				'label'       => esc_html__( 'Reviews Section Title', 'cinerama-core' ),
				'description' => esc_html__( 'Enter title that you want to show before average rating for each room', 'cinerama-core' ),
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'textarea',
				'name'        => 'reviews_section_subtitle',
				'label'       => esc_html__( 'Reviews Section Subtitle', 'cinerama-core' ),
				'description' => esc_html__( 'Enter subtitle that you want to show before average rating for each room', 'cinerama-core' ),
			)
		);
	}
	
	add_action( 'cinerama_edge_action_additional_page_options_map', 'cinerama_core_reviews_map', 75 ); //one after elements
}