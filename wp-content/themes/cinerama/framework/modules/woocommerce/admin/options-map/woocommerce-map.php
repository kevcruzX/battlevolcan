<?php

if ( ! function_exists( 'cinerama_edge_woocommerce_options_map' ) ) {
	
	/**
	 * Add Woocommerce options page
	 */
	function cinerama_edge_woocommerce_options_map() {
		
		cinerama_edge_add_admin_page(
			array(
				'slug'  => '_woocommerce_page',
				'title' => esc_html__( 'Woocommerce', 'cinerama' ),
				'icon'  => 'fa fa-shopping-cart'
			)
		);
		
		/**
		 * Product List Settings
		 */
		$panel_product_list = cinerama_edge_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_product_list',
				'title' => esc_html__( 'Product List', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_woo_product_list_columns',
				'label'         => esc_html__( 'Product List Columns', 'cinerama' ),
				'default_value' => 'edgtf-woocommerce-columns-4',
				'description'   => esc_html__( 'Choose number of columns for main shop page', 'cinerama' ),
				'options'       => array(
					'edgtf-woocommerce-columns-3' => esc_html__( '3 Columns', 'cinerama' ),
					'edgtf-woocommerce-columns-4' => esc_html__( '4 Columns', 'cinerama' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_woo_product_list_columns_space',
				'label'         => esc_html__( 'Space Between Items', 'cinerama' ),
				'description'   => esc_html__( 'Select space between items for product listing and related products on single product', 'cinerama' ),
				'default_value' => 'normal',
				'options'       => cinerama_edge_get_space_between_items_array(),
				'parent'        => $panel_product_list,
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_woo_product_list_info_position',
				'label'         => esc_html__( 'Product Info Position', 'cinerama' ),
				'default_value' => 'info_below_image',
				'description'   => esc_html__( 'Select product info position for product listing and related products on single product', 'cinerama' ),
				'options'       => array(
					'info_below_image'    => esc_html__( 'Info Below Image', 'cinerama' ),
					'info_on_image_hover' => esc_html__( 'Info On Image Hover', 'cinerama' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'edgtf_woo_products_per_page',
				'label'         => esc_html__( 'Number of products per page', 'cinerama' ),
				'description'   => esc_html__( 'Set number of products on shop page', 'cinerama' ),
				'parent'        => $panel_product_list,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_products_list_title_tag',
				'label'         => esc_html__( 'Products Title Tag', 'cinerama' ),
				'default_value' => 'h5',
				'options'       => cinerama_edge_get_title_tag(),
				'parent'        => $panel_product_list,
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'woo_enable_percent_sign_value',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Percent Sign', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show percent value mark instead of sale label on products', 'cinerama' ),
				'parent'        => $panel_product_list
			)
		);
		
		/**
		 * Single Product Settings
		 */
		$panel_single_product = cinerama_edge_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_single_product',
				'title' => esc_html__( 'Single Product', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_woo',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'cinerama' ),
				'parent'        => $panel_single_product,
				'options'       => cinerama_edge_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_single_product_title_tag',
				'default_value' => 'h2',
				'label'         => esc_html__( 'Single Product Title Tag', 'cinerama' ),
				'options'       => cinerama_edge_get_title_tag(),
				'parent'        => $panel_single_product,
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_number_of_thumb_images',
				'default_value' => '4',
				'label'         => esc_html__( 'Number of Thumbnail Images per Row', 'cinerama' ),
				'options'       => array(
					'4' => esc_html__( 'Four', 'cinerama' ),
					'3' => esc_html__( 'Three', 'cinerama' ),
					'2' => esc_html__( 'Two', 'cinerama' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_thumb_images_position',
				'default_value' => 'below-image',
				'label'         => esc_html__( 'Set Thumbnail Images Position', 'cinerama' ),
				'options'       => array(
					'below-image'  => esc_html__( 'Below Featured Image', 'cinerama' ),
					'on-left-side' => esc_html__( 'On The Left Side Of Featured Image', 'cinerama' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_enable_single_product_zoom_image',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Zoom Maginfier', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show magnifier image on featured image hover', 'cinerama' ),
				'parent'        => $panel_single_product,
				'options'       => cinerama_edge_get_yes_no_select_array( false ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_single_images_behavior',
				'default_value' => 'pretty-photo',
				'label'         => esc_html__( 'Set Images Behavior', 'cinerama' ),
				'options'       => array(
					'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'cinerama' ),
					'photo-swipe'  => esc_html__( 'Photo Swipe Lightbox', 'cinerama' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_woo_related_products_columns',
				'label'         => esc_html__( 'Related Products Columns', 'cinerama' ),
				'default_value' => 'edgtf-woocommerce-columns-4',
				'description'   => esc_html__( 'Choose number of columns for related products on single product page', 'cinerama' ),
				'options'       => array(
					'edgtf-woocommerce-columns-3' => esc_html__( '3 Columns', 'cinerama' ),
					'edgtf-woocommerce-columns-4' => esc_html__( '4 Columns', 'cinerama' )
				),
				'parent'        => $panel_single_product,
			)
		);

		do_action('cinerama_edge_woocommerce_additional_options_map');
	}
	
	add_action( 'cinerama_edge_action_options_map', 'cinerama_edge_woocommerce_options_map', 21 );
}