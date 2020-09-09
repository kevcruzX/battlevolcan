<?php

if ( ! function_exists( 'cinerama_edge_logo_options_map' ) ) {
	function cinerama_edge_logo_options_map() {
		
		cinerama_edge_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'cinerama' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = cinerama_edge_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'cinerama' )
			)
		);
		
		$hide_logo_container = cinerama_edge_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'cinerama' ),
				'parent'        => $hide_logo_container
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'cinerama' ),
				'parent'        => $hide_logo_container
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'cinerama' ),
				'parent'        => $hide_logo_container
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'cinerama' ),
				'parent'        => $hide_logo_container
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'cinerama' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'cinerama_edge_action_options_map', 'cinerama_edge_logo_options_map', 2 );
}