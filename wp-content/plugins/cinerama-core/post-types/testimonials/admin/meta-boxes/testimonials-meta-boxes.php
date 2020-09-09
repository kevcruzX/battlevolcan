<?php

if ( ! function_exists( 'cinerama_core_map_testimonials_meta' ) ) {
	function cinerama_core_map_testimonials_meta() {
		$testimonial_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'cinerama-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'cinerama-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'cinerama-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'cinerama-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'cinerama-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'cinerama-core' ),
				'description' => esc_html__( 'Enter author name', 'cinerama-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'cinerama-core' ),
				'description' => esc_html__( 'Enter author job position', 'cinerama-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_core_map_testimonials_meta', 95 );
}