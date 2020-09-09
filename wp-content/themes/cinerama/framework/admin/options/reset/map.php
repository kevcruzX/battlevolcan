<?php

if ( ! function_exists( 'cinerama_edge_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function cinerama_edge_reset_options_map() {
		
		cinerama_edge_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'cinerama' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = cinerama_edge_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'cinerama' )
			)
		);
		
		cinerama_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'cinerama' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'cinerama' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'cinerama_edge_action_options_map', 'cinerama_edge_reset_options_map', 100 );
}