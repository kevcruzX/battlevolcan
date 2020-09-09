<?php

/*** Post Settings ***/

if ( ! function_exists( 'cinerama_edge_map_post_meta' ) ) {
	function cinerama_edge_map_post_meta() {
		
		$post_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'cinerama' ),
				'name'  => 'post-meta'
			)
		);

		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_blog_single_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Single Layout', 'cinerama' ),
				'description'   => esc_html__( 'Choose a layout for Blog Single page', 'cinerama' ),
				'parent'        => $post_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'cinerama' ),
					'standard' => esc_html__( 'Standard', 'cinerama' ),
					'classic'  => esc_html__( 'Classic', 'cinerama' )
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'cinerama' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'cinerama' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => cinerama_edge_get_custom_sidebars_options( true )
			)
		);

		$cinerama_custom_sidebars = cinerama_edge_get_custom_sidebars();
		if ( count( $cinerama_custom_sidebars ) > 0 ) {
			cinerama_edge_create_meta_box_field( array(
				'name'        => 'edgtf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'cinerama' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'cinerama' ),
				'parent'      => $post_meta_box,
				'options'     => cinerama_edge_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}

		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'cinerama' ),
				'parent'        => $post_meta_box,
				'options'       => cinerama_edge_get_yes_no_select_array()
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'cinerama' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'cinerama' ),
				'parent'      => $post_meta_box
			)
		);

		do_action('cinerama_edge_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_map_post_meta', 20 );
}
