<?php

foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'cinerama_edge_map_blog_meta' ) ) {
	function cinerama_edge_map_blog_meta() {
		$edgtf_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$edgtf_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'cinerama' ),
				'name'  => 'blog_meta'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'cinerama' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'cinerama' ),
				'parent'      => $blog_meta_box,
				'options'     => $edgtf_blog_categories
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'cinerama' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'cinerama' ),
				'parent'      => $blog_meta_box,
				'options'     => $edgtf_blog_categories,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'cinerama' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'cinerama' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'cinerama' ),
					'in-grid'    => esc_html__( 'In Grid', 'cinerama' ),
					'full-width' => esc_html__( 'Full Width', 'cinerama' )
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'cinerama' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'cinerama' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''      => esc_html__( 'Default', 'cinerama' ),
					'two'   => esc_html__( '2 Columns', 'cinerama' ),
					'three' => esc_html__( '3 Columns', 'cinerama' ),
					'four'  => esc_html__( '4 Columns', 'cinerama' ),
					'five'  => esc_html__( '5 Columns', 'cinerama' )
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'cinerama' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'cinerama' ),
				'options'     => cinerama_edge_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'cinerama' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'cinerama' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'cinerama' ),
					'fixed'    => esc_html__( 'Fixed', 'cinerama' ),
					'original' => esc_html__( 'Original', 'cinerama' )
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'cinerama' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'cinerama' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'cinerama' ),
					'standard'        => esc_html__( 'Standard', 'cinerama' ),
					'load-more'       => esc_html__( 'Load More', 'cinerama' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'cinerama' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'cinerama' )
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'edgtf_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'cinerama' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'cinerama' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_map_blog_meta', 30 );
}