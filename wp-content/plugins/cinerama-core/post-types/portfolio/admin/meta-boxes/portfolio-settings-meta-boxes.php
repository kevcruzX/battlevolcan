<?php

if ( ! function_exists( 'cinerama_core_map_portfolio_settings_meta' ) ) {
	function cinerama_core_map_portfolio_settings_meta() {
		$meta_box = cinerama_edge_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'cinerama-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		cinerama_edge_create_meta_box_field( array(
			'name'        => 'edgtf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'cinerama-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'cinerama-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'cinerama-core' ),
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
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = cinerama_edge_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'edgtf_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'edgtf_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'cinerama-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'cinerama-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => array(
					''      => esc_html__( 'Default', 'cinerama-core' ),
					'two'   => esc_html__( '2 Columns', 'cinerama-core' ),
					'three' => esc_html__( '3 Columns', 'cinerama-core' ),
					'four'  => esc_html__( '4 Columns', 'cinerama-core' )
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'cinerama-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'cinerama-core' ),
				'default_value' => '',
				'options'       => cinerama_edge_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = cinerama_edge_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'edgtf_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'edgtf_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'cinerama-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'cinerama-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => array(
					''      => esc_html__( 'Default', 'cinerama-core' ),
					'two'   => esc_html__( '2 Columns', 'cinerama-core' ),
					'three' => esc_html__( '3 Columns', 'cinerama-core' ),
					'four'  => esc_html__( '4 Columns', 'cinerama-core' )
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'cinerama-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'cinerama-core' ),
				'default_value' => '',
				'options'       => cinerama_edge_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'cinerama-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'cinerama-core' ),
				'parent'        => $meta_box,
				'options'       => cinerama_edge_get_yes_no_select_array()
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'cinerama-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'cinerama-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'cinerama-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'cinerama-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'cinerama-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'cinerama-core' ),
				'parent'      => $meta_box
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'cinerama-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'cinerama-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'cinerama-core' ),
					'small'              => esc_html__( 'Small', 'cinerama-core' ),
					'large-width'        => esc_html__( 'Large Width', 'cinerama-core' ),
					'large-height'       => esc_html__( 'Large Height', 'cinerama-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'cinerama-core' )
				)
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'cinerama-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'cinerama-core' ),
				'default_value' => 'default',
				'parent'        => $meta_box,
				'options'       => array(
					'default'     => esc_html__( 'Default', 'cinerama-core' ),
					'large-width' => esc_html__( 'Large Width', 'cinerama-core' )
				)
			)
		);

		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_navigation_skin_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Single Portfolio Navigation Skin', 'cinerama-core' ),
				'description'   => esc_html__( 'Choose skin for single portfolio navigation', 'cinerama-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''      => esc_html__( 'Default', 'cinerama-core' ),
					'light' => esc_html__( 'Light', 'cinerama-core' )
				)
			)
		);

		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'cinerama-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'cinerama-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_core_map_portfolio_settings_meta', 41 );
}