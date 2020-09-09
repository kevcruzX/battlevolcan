<?php

if ( ! function_exists( 'cinerama_edge_portfolio_options_map' ) ) {
	function cinerama_edge_portfolio_options_map() {
		
		cinerama_edge_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'cinerama-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = cinerama_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'cinerama-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'cinerama-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'cinerama-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'cinerama-core' ),
				'default_value' => '4',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is 4 columns', 'cinerama-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'2' => esc_html__( '2 Columns', 'cinerama-core' ),
					'3' => esc_html__( '3 Columns', 'cinerama-core' ),
					'4' => esc_html__( '4 Columns', 'cinerama-core' ),
					'5' => esc_html__( '5 Columns', 'cinerama-core' )
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'cinerama-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'cinerama-core' ),
				'default_value' => 'normal',
				'options'       => cinerama_edge_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'cinerama-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'cinerama-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'cinerama-core' ),
					'landscape' => esc_html__( 'Landscape', 'cinerama-core' ),
					'portrait'  => esc_html__( 'Portrait', 'cinerama-core' ),
					'square'    => esc_html__( 'Square', 'cinerama-core' )
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'cinerama-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'cinerama-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'cinerama-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'cinerama-core' )
				)
			)
		);
		
		$panel = cinerama_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'cinerama-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'cinerama-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'cinerama-core' ),
				'parent'        => $panel,
				'options'       => array(
					'images'            => esc_html__( 'Portfolio Images', 'cinerama-core' ),
					'small-images'      => esc_html__( 'Portfolio Small Images', 'cinerama-core' ),
					'slider'            => esc_html__( 'Portfolio Slider', 'cinerama-core' ),
					'small-slider'      => esc_html__( 'Portfolio Small Slider', 'cinerama-core' ),
					'gallery'           => esc_html__( 'Portfolio Gallery', 'cinerama-core' ),
					'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'cinerama-core' ),
					'masonry'           => esc_html__( 'Portfolio Masonry', 'cinerama-core' ),
					'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'cinerama-core' ),
					'custom'            => esc_html__( 'Portfolio Custom', 'cinerama-core' ),
					'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'cinerama-core' )
				)
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = cinerama_edge_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'cinerama-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'cinerama-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => array(
					'two'   => esc_html__( '2 Columns', 'cinerama-core' ),
					'three' => esc_html__( '3 Columns', 'cinerama-core' ),
					'four'  => esc_html__( '4 Columns', 'cinerama-core' )
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'cinerama-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'cinerama-core' ),
				'default_value' => 'normal',
				'options'       => cinerama_edge_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = cinerama_edge_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'cinerama-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'cinerama-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => array(
					'two'   => esc_html__( '2 Columns', 'cinerama-core' ),
					'three' => esc_html__( '3 Columns', 'cinerama-core' ),
					'four'  => esc_html__( '4 Columns', 'cinerama-core' )
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'cinerama-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'cinerama-core' ),
				'default_value' => 'normal',
				'options'       => cinerama_edge_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'cinerama-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'cinerama-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'cinerama-core' ),
					'yes' => esc_html__( 'Yes', 'cinerama-core' ),
					'no'  => esc_html__( 'No', 'cinerama-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'cinerama-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'cinerama-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'cinerama-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'cinerama-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'cinerama-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'cinerama-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'cinerama-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'cinerama-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);

		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_tags',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Tags', 'cinerama-core' ),
				'description'   => esc_html__( 'Enabling this option will enable tag meta description on single projects', 'cinerama-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'cinerama-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'cinerama-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'cinerama-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'cinerama-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'cinerama-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'cinerama-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = cinerama_edge_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'cinerama-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'cinerama-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'cinerama-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'cinerama-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'cinerama_edge_action_options_map', 'cinerama_edge_portfolio_options_map', 14 );
}