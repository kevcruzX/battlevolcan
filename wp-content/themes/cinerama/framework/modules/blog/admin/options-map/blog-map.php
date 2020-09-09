<?php

if ( ! function_exists( 'cinerama_edge_get_blog_list_types_options' ) ) {
	function cinerama_edge_get_blog_list_types_options() {
		$blog_list_type_options = apply_filters( 'cinerama_edge_filter_blog_list_type_global_option', $blog_list_type_options = array() );
		
		return $blog_list_type_options;
	}
}

if ( ! function_exists( 'cinerama_edge_blog_options_map' ) ) {
	function cinerama_edge_blog_options_map() {
		$blog_list_type_options = cinerama_edge_get_blog_list_types_options();
		
		cinerama_edge_add_admin_page(
			array(
				'slug'  => '_blog_page',
				'title' => esc_html__( 'Blog', 'cinerama' ),
				'icon'  => 'fa fa-files-o'
			)
		);
		
		/**
		 * Blog Lists
		 */
		$panel_blog_lists = cinerama_edge_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_lists',
				'title' => esc_html__( 'Blog Lists', 'cinerama' )
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'name'        => 'blog_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'cinerama' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for blog post lists. Default value is large', 'cinerama' ),
				'options'     => cinerama_edge_get_space_between_items_array( true ),
				'parent'      => $panel_blog_lists
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'blog_list_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Blog Layout for Archive Pages', 'cinerama' ),
				'description'   => esc_html__( 'Choose a default blog layout for archived blog post lists', 'cinerama' ),
				'default_value' => 'standard',
				'parent'        => $panel_blog_lists,
				'options'       => $blog_list_type_options
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'archive_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout for Archive Pages', 'cinerama' ),
				'description'   => esc_html__( 'Choose a sidebar layout for archived blog post lists', 'cinerama' ),
				'default_value' => '',
				'parent'        => $panel_blog_lists,
                'options'       => cinerama_edge_get_custom_sidebars_options(),
			)
		);
		
		$cinerama_custom_sidebars = cinerama_edge_get_custom_sidebars();
		if ( count( $cinerama_custom_sidebars ) > 0 ) {
			cinerama_edge_add_admin_field(
				array(
					'name'        => 'archive_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display for Archive Pages', 'cinerama' ),
					'description' => esc_html__( 'Choose a sidebar to display on archived blog post lists. Default sidebar is "Sidebar Page"', 'cinerama' ),
					'parent'      => $panel_blog_lists,
					'options'     => cinerama_edge_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'blog_masonry_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Layout', 'cinerama' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set masonry layout. Default is in grid.', 'cinerama' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'cinerama' ),
					'full-width' => esc_html__( 'Full Width', 'cinerama' )
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'blog_masonry_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Number of Columns', 'cinerama' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for your masonry blog lists. Default value is 4 columns', 'cinerama' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'two'   => esc_html__( '2 Columns', 'cinerama' ),
					'three' => esc_html__( '3 Columns', 'cinerama' ),
					'four'  => esc_html__( '4 Columns', 'cinerama' ),
					'five'  => esc_html__( '5 Columns', 'cinerama' )
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'blog_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Space Between Items', 'cinerama' ),
				'description'   => esc_html__( 'Set space size between posts for your masonry blog lists. Default value is normal', 'cinerama' ),
				'default_value' => 'normal',
				'options'       => cinerama_edge_get_space_between_items_array(),
				'parent'        => $panel_blog_lists
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'blog_list_featured_image_proportion',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'cinerama' ),
				'default_value' => 'fixed',
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'cinerama' ),
				'parent'        => $panel_blog_lists,
				'options'       => array(
					'fixed'    => esc_html__( 'Fixed', 'cinerama' ),
					'original' => esc_html__( 'Original', 'cinerama' )
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'blog_pagination_type',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'cinerama' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'cinerama' ),
				'parent'        => $panel_blog_lists,
				'default_value' => 'standard',
				'options'       => array(
					'standard'        => esc_html__( 'Standard', 'cinerama' ),
					'load-more'       => esc_html__( 'Load More', 'cinerama' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'cinerama' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'cinerama' )
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'number_of_chars',
				'default_value' => '40',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'cinerama' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 40', 'cinerama' ),
				'parent'        => $panel_blog_lists,
				'args'          => array(
					'col_width' => 3
				)
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_tags_area_blog',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Blog Tags on Standard List', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show tags on standard blog list', 'cinerama' ),
				'parent'        => $panel_blog_lists
			)
		);
		
		/**
		 * Blog Single
		 */
		$panel_blog_single = cinerama_edge_add_admin_panel(
			array(
				'page'  => '_blog_page',
				'name'  => 'panel_blog_single',
				'title' => esc_html__( 'Blog Single', 'cinerama' )
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'name'          => 'blog_single_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Single Layout', 'cinerama' ),
				'description'   => esc_html__( 'Choose a layout for Blog Single pages', 'cinerama' ),
				'parent'        => $panel_blog_single,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'cinerama' ),
					'standard' => esc_html__( 'Standard', 'cinerama' ),
					'classic'  => esc_html__( 'Classic', 'cinerama' )
				)
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'name'        => 'blog_single_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'cinerama' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for Blog Single pages. Default value is large', 'cinerama' ),
				'options'     => cinerama_edge_get_space_between_items_array( true ),
				'parent'      => $panel_blog_single
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'blog_single_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'cinerama' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog Single pages', 'cinerama' ),
				'default_value' => '',
				'parent'        => $panel_blog_single,
                'options'       => cinerama_edge_get_custom_sidebars_options()
			)
		);
		
		if ( count( $cinerama_custom_sidebars ) > 0 ) {
			cinerama_edge_add_admin_field(
				array(
					'name'        => 'blog_single_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'cinerama' ),
					'description' => esc_html__( 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"', 'cinerama' ),
					'parent'      => $panel_blog_single,
					'options'     => cinerama_edge_get_custom_sidebars(),
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_blog',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'cinerama' ),
				'parent'        => $panel_blog_single,
				'options'       => cinerama_edge_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'blog_single_title_in_title_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Post Title in Title Area', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show post title in title area on single post pages', 'cinerama' ),
				'parent'        => $panel_blog_single,
				'dependency' => array(
					'hide' => array(
						'show_title_area_blog' => 'no'
					)
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'enable_unique_date_format',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Unique Date Format', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show unique date format', 'cinerama' ),
				'parent'        => $panel_blog_single
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'blog_single_related_posts',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Related Posts', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show related posts on single post pages', 'cinerama' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'blog_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments Form', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show comments form on single post pages', 'cinerama' ),
				'parent'        => $panel_blog_single,
				'default_value' => 'yes'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_navigation',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Prev/Next Single Post Navigation Links', 'cinerama' ),
				'description'   => esc_html__( 'Enable navigation links through the blog posts (left and right arrows will appear)', 'cinerama' ),
				'parent'        => $panel_blog_single
			)
		);
		
		$blog_single_navigation_container = cinerama_edge_add_admin_container(
			array(
				'name'            => 'edgtf_blog_single_navigation_container',
				'parent'          => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_single_navigation' => 'yes'
					)
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Navigation Only in Current Category', 'cinerama' ),
				'description'   => esc_html__( 'Limit your navigation only through current category', 'cinerama' ),
				'parent'        => $blog_single_navigation_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Info Box', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will display author name and descriptions on single post pages. Author biographic info field in Users section must contain some data', 'cinerama' ),
				'parent'        => $panel_blog_single
			)
		);
		
		$blog_single_author_info_container = cinerama_edge_add_admin_container(
			array(
				'name'            => 'edgtf_blog_single_author_info_container',
				'parent'          => $panel_blog_single,
				'dependency' => array(
					'show' => array(
						'blog_author_info' => 'yes'
					)
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_author_info_email',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show Author Email', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show author email', 'cinerama' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'blog_single_author_social',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Author Social Icons', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show author social icons on single post pages', 'cinerama' ),
				'parent'        => $blog_single_author_info_container,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		do_action( 'cinerama_edge_action_blog_single_options_map', $panel_blog_single );
	}
	
	add_action( 'cinerama_edge_action_options_map', 'cinerama_edge_blog_options_map', 13 );
}