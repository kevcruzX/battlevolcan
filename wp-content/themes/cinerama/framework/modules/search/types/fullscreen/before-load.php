<?php

if ( ! function_exists( 'cinerama_edge_set_search_fullscreen_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function cinerama_edge_set_search_fullscreen_global_option( $search_type_options ) {
        $search_type_options['fullscreen'] = esc_html__( 'Fullscreen', 'cinerama' );

        return $search_type_options;
    }

    add_filter( 'cinerama_edge_filter_search_type_global_option', 'cinerama_edge_set_search_fullscreen_global_option' );
}