<?php

if ( ! function_exists( 'cinerama_edge_portfolio_category_additional_fields' ) ) {
	function cinerama_edge_portfolio_category_additional_fields() {
		
		$fields = cinerama_edge_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		cinerama_edge_add_taxonomy_field(
			array(
				'name'   => 'edgtf_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'cinerama-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'cinerama_edge_action_custom_taxonomy_fields', 'cinerama_edge_portfolio_category_additional_fields' );
}