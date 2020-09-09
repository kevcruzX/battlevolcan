<?php

if ( ! function_exists( 'cinerama_edge_register_widgets' ) ) {
	function cinerama_edge_register_widgets() {
		$widgets = apply_filters( 'cinerama_edge_filter_register_widgets', $widgets = array() );

		if(cinerama_edge_core_plugin_installed()) {
			foreach ($widgets as $widget) {
				cinerama_edge_create_wp_widget($widget);
			}
		}
	}

	add_action( 'widgets_init', 'cinerama_edge_register_widgets' );
}

