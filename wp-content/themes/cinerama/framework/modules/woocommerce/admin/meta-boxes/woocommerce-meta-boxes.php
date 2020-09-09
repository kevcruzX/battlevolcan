<?php

if ( ! function_exists( 'cinerama_edge_map_woocommerce_meta' ) ) {
	function cinerama_edge_map_woocommerce_meta() {
		
		$woocommerce_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'cinerama' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'cinerama' ),
				'description' => esc_html__( 'Choose image layout when it appears in Edge Product List - Masonry layout shortcode', 'cinerama' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'cinerama' ),
					'small'              => esc_html__( 'Small', 'cinerama' ),
					'large-width'        => esc_html__( 'Large Width', 'cinerama' ),
					'large-height'       => esc_html__( 'Large Height', 'cinerama' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'cinerama' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'cinerama' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'cinerama' ),
				'options'       => cinerama_edge_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'cinerama' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_map_woocommerce_meta', 99 );
}