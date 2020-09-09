<?php

if ( ! function_exists( 'cinerama_edge_centered_title_type_options_meta_boxes' ) ) {
	function cinerama_edge_centered_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_subtitle_side_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Side Padding', 'cinerama' ),
				'description' => esc_html__( 'Set left/right padding for subtitle area', 'cinerama' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);
	}
	
	add_action( 'cinerama_edge_action_additional_title_area_meta_boxes', 'cinerama_edge_centered_title_type_options_meta_boxes', 5 );
}