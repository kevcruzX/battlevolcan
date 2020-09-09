<?php

if ( ! function_exists( 'cinerama_edge_register_header_vertical_sliding_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function cinerama_edge_register_header_vertical_sliding_type( $header_types ) {
		$header_type = array(
			'header-vertical-sliding' => 'CineramaEdgeNamespace\Modules\Header\Types\HeaderVerticalSliding'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'cinerama_edge_init_register_header_vertical_sliding_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function cinerama_edge_init_register_header_vertical_sliding_type() {
		add_filter( 'cinerama_edge_filter_register_header_type_class', 'cinerama_edge_register_header_vertical_sliding_type' );
	}
	
	add_action( 'cinerama_edge_action_before_header_function_init', 'cinerama_edge_init_register_header_vertical_sliding_type' );
}

if ( ! function_exists( 'cinerama_edge_include_header_vertical_sliding_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function cinerama_edge_include_header_vertical_sliding_menu( $menus ) {
		if ( ! array_key_exists( 'vertical-navigation', $menus ) ) {
			$menus['vertical-navigation'] = esc_html__( 'Vertical Navigation', 'cinerama' );
		}
		
		return $menus;
	}
	
	if ( cinerama_edge_check_is_header_type_enabled( 'header-vertical-sliding' ) ) {
		add_filter( 'cinerama_edge_filter_register_headers_menu', 'cinerama_edge_include_header_vertical_sliding_menu' );
	}
}

if ( ! function_exists( 'cinerama_edge_register_header_vertical_sliding_widget_areas' ) ) {
	/**
	 * Registers additional widget areas for this header type
	 */
	function cinerama_edge_register_header_vertical_sliding_widget_areas() {
		register_sidebar(
			array(
				'id'            => 'edgtf-vertical-sliding-area',
				'name'          => esc_html__( 'Header Vertical Sliding Widget Area', 'cinerama' ),
				'description'   => esc_html__( 'Widgets added here will appear on the bottom of header vertical menu', 'cinerama' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-vertical-area-widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<h5 class="edgtf-widget-title">',
				'after_title'   => '</h5>'
			)
		);
	}
	
	if ( cinerama_edge_check_is_header_type_enabled( 'header-vertical-sliding' ) ) {
		add_action( 'widgets_init', 'cinerama_edge_register_header_vertical_sliding_widget_areas' );
	}
}

if ( ! function_exists( 'cinerama_edge_get_header_vertical_sliding_widget_areas' ) ) {
	/**
	 * Loads header widgets area HTML
	 */
	function cinerama_edge_get_header_vertical_sliding_widget_areas() {
		$page_id                            = cinerama_edge_get_page_id();
		$custom_vertical_header_widget_area = get_post_meta( $page_id, 'edgtf_custom_vertical_area_sidebar_meta', true );
		
		if ( is_active_sidebar( 'edgtf-vertical-sliding-area' ) && empty( $custom_vertical_header_widget_area ) ) {
			dynamic_sidebar( 'edgtf-vertical-sliding-area' );
		} else if ( ! empty( $custom_vertical_header_widget_area ) && is_active_sidebar( $custom_vertical_header_widget_area ) ) {
			dynamic_sidebar( $custom_vertical_header_widget_area );
		}
	}
}

if ( ! function_exists( 'cinerama_edge_get_header_vertical_sliding_main_menu' ) ) {
	/**
	 * Loads vertical menu HTML
	 */
	function cinerama_edge_get_header_vertical_sliding_main_menu() {
		cinerama_edge_get_module_template_part( 'templates/vertical-sliding-navigation', 'header/types/header-vertical-sliding' );
	}
}

if ( ! function_exists( 'cinerama_edge_vertical_sliding_header_holder_class' ) ) {
	/**
	 * Return holder class for this header type html
	 */
	function cinerama_edge_vertical_sliding_header_holder_class() {
		$center_content = cinerama_edge_get_meta_field_intersect( 'vertical_header_center_content', cinerama_edge_get_page_id() );
		$holder_class   = $center_content === 'yes' ? 'edgtf-vertical-alignment-center' : 'edgtf-vertical-alignment-top';
		
		return $holder_class;
	}
}

if ( ! function_exists( 'cinerama_edge_header_vertical_sliding_per_page_custom_styles' ) ) {
    /**
     * Return header per page styles
     */
    function cinerama_edge_header_vertical_sliding_per_page_custom_styles( $style, $class_prefix, $page_id ) {
        $header_area_style    = array();
        $header_area_selector = array( $class_prefix . '.edgtf-header-vertical-sliding .edgtf-vertical-menu-area .edgtf-vertical-area-background' );

        $vertical_header_background_color  = get_post_meta( $page_id, 'edgtf_vertical_header_background_color_meta', true );
        $disable_vertical_background_image = get_post_meta( $page_id, 'edgtf_disable_vertical_header_background_image_meta', true );
        $vertical_background_image         = get_post_meta( $page_id, 'edgtf_vertical_header_background_image_meta', true );
        $vertical_shadow                   = get_post_meta( $page_id, 'edgtf_vertical_header_shadow_meta', true );
        $vertical_border                   = get_post_meta( $page_id, 'edgtf_vertical_header_border_meta', true );

        if ( ! empty( $vertical_header_background_color ) ) {
            $header_area_style['background-color'] = $vertical_header_background_color;
        }

        if ( $disable_vertical_background_image == 'yes' ) {
            $header_area_style['background-image'] = 'none';
        } elseif ( $vertical_background_image !== '' ) {
            $header_area_style['background-image'] = 'url(' . $vertical_background_image . ')';
        }

        if ( $vertical_shadow == 'yes' ) {
            $header_area_style['box-shadow'] = '1px 0 3px rgba(0, 0, 0, 0.05)';
        }

        if ( $vertical_border == 'yes' ) {
            $header_border_color = get_post_meta( $page_id, 'edgtf_vertical_header_border_color_meta', true );

            if ( $header_border_color !== '' ) {
                $header_area_style['border-right'] = '1px solid ' . $header_border_color;
            }
        }

        $current_style = '';

        if ( ! empty( $header_area_style ) ) {
            $current_style .= cinerama_edge_dynamic_css( $header_area_selector, $header_area_style );
        }

        $current_style = $current_style . $style;

        return $current_style;
    }

    add_filter( 'cinerama_edge_filter_add_header_page_custom_style', 'cinerama_edge_header_vertical_sliding_per_page_custom_styles', 10, 3 );
}

if ( ! function_exists( 'cinerama_edge_get_vertical_sliding_header_icon_class' ) ) {
	/**
	 * Loads vertical closed icon class
	 */
	function cinerama_edge_get_vertical_sliding_header_icon_class() {
		$classes = array(
			'edgtf-vertical-sliding-opener'
		);
		
		$classes[] = cinerama_edge_get_icon_sources_class( 'vertical_sliding', 'edgtf-vertical-sliding-opener' );
		
		return $classes;
	}
}