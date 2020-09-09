<?php

if (!function_exists('cinerama_edge_theme_version_class')) {
    /**
     * Function that adds classes on body for version of theme
     */
    function cinerama_edge_theme_version_class($classes) {
        $current_theme = wp_get_theme();

        //is child theme activated?
        if ($current_theme->parent()) {
            //add child theme version
            $classes[] = strtolower($current_theme->get('Name')) . '-child-ver-' . $current_theme->get('Version');

            //get parent theme
            $current_theme = $current_theme->parent();
        }

        if ($current_theme->exists() && $current_theme->get('Version') != '') {
            $classes[] = strtolower($current_theme->get('Name')) . '-ver-' . $current_theme->get('Version');
        }

        return $classes;
    }

    add_filter('body_class', 'cinerama_edge_theme_version_class');
}

if (!function_exists('cinerama_edge_boxed_class')) {
    /**
     * Function that adds classes on body for boxed layout
     */
    function cinerama_edge_boxed_class($classes) {
        $allow_boxed_layout = true;
        $allow_boxed_layout = apply_filters('cinerama_edge_filter_allow_content_boxed_layout', $allow_boxed_layout);

        if ($allow_boxed_layout && cinerama_edge_get_meta_field_intersect('boxed') === 'yes') {
            $classes[] = 'edgtf-boxed';
        }

        return $classes;
    }

    add_filter('body_class', 'cinerama_edge_boxed_class');
}

if (!function_exists('cinerama_edge_paspartu_class')) {
    /**
     * Function that adds classes on body for paspartu layout
     */
    function cinerama_edge_paspartu_class($classes) {
        $id = cinerama_edge_get_page_id();

        //is paspartu layout turned on?
        if (cinerama_edge_get_meta_field_intersect('paspartu', $id) === 'yes') {
            $classes[] = 'edgtf-paspartu-enabled';

            if (cinerama_edge_get_meta_field_intersect('disable_top_paspartu', $id) === 'yes') {
                $classes[] = 'edgtf-top-paspartu-disabled';
            }

            if (cinerama_edge_get_meta_field_intersect('enable_fixed_paspartu', $id) === 'yes') {
                $classes[] = 'edgtf-fixed-paspartu-enabled';
            }
        }

        return $classes;
    }

    add_filter('body_class', 'cinerama_edge_paspartu_class');
}

if (!function_exists('cinerama_edge_page_smooth_scroll_class')) {
    /**
     * Function that adds classes on body for page smooth scroll
     */
    function cinerama_edge_page_smooth_scroll_class($classes) {
        //is smooth scroll enabled enabled?
        if (cinerama_edge_options()->getOptionValue('page_smooth_scroll') == 'yes') {
            $classes[] = 'edgtf-smooth-scroll';
        }

        return $classes;
    }

    add_filter('body_class', 'cinerama_edge_page_smooth_scroll_class');
}

if (!function_exists('cinerama_edge_smooth_page_transitions_class')) {
    /**
     * Function that adds classes on body for smooth page transitions
     */
    function cinerama_edge_smooth_page_transitions_class($classes) {
        $id = cinerama_edge_get_page_id();

        if (cinerama_edge_get_meta_field_intersect('smooth_page_transitions', $id) == 'yes') {
            $classes[] = 'edgtf-smooth-page-transitions';

            if (cinerama_edge_get_meta_field_intersect('page_transition_preloader', $id) == 'yes') {
                $classes[] = 'edgtf-smooth-page-transitions-preloader';
            }

            if (cinerama_edge_get_meta_field_intersect('page_transition_fadeout', $id) == 'yes') {
                $classes[] = 'edgtf-smooth-page-transitions-fadeout';
            }
        }

        return $classes;
    }

    add_filter('body_class', 'cinerama_edge_smooth_page_transitions_class');
}

if (!function_exists('cinerama_edge_content_initial_width_body_class')) {
    /**
     * Function that adds transparent content class to body.
     *
     * @param $classes array of body classes
     *
     * @return array with transparent content body class added
     */
    function cinerama_edge_content_initial_width_body_class($classes) {
        $initial_content_width = cinerama_edge_get_meta_field_intersect('initial_content_width', cinerama_edge_get_page_id());

        if (!empty($initial_content_width)) {
            $classes[] = $initial_content_width;
        }

        return $classes;
    }

    add_filter('body_class', 'cinerama_edge_content_initial_width_body_class');
}

if (!function_exists('cinerama_edge_set_content_behind_header_class')) {
    function cinerama_edge_set_content_behind_header_class($classes) {
        $id = cinerama_edge_get_page_id();

        if (get_post_meta($id, 'edgtf_page_content_behind_header_meta', true) === 'yes') {
            $classes[] = 'edgtf-content-is-behind-header';
        }

        return $classes;
    }

    add_filter('body_class', 'cinerama_edge_set_content_behind_header_class');
}

if (!function_exists('cinerama_edge_set_no_google_api_class')) {
    function cinerama_edge_set_no_google_api_class($classes) {
        $google_map_api = cinerama_edge_options()->getOptionValue('google_maps_api_key');

        if (empty($google_map_api)) {
            $classes[] = 'edgtf-empty-google-api';
        }

        return $classes;
    }

    add_filter('body_class', 'cinerama_edge_set_no_google_api_class');
}

if (!function_exists('cinerama_edge_wide_menu_body_class')) {
    /**
     * Function that adds wide menu width control classes to body.
     *
     * @param $classes array of body classes
     *
     * @return array with wide menu width control body classes added
     */
    function cinerama_edge_wide_menu_body_class($classes) {
        $wide_dropdown_menu_in_grid = cinerama_edge_get_meta_field_intersect('wide_dropdown_menu_in_grid', cinerama_edge_get_page_id());
        $wide_dropdown_menu_in_grid_meta = get_post_meta(cinerama_edge_get_page_id(), 'edgtf_wide_dropdown_menu_in_grid_meta', true);

        $wide_dropdown_menu_content_in_grid = cinerama_edge_get_meta_field_intersect('wide_dropdown_menu_content_in_grid', cinerama_edge_get_page_id());
        $wide_dropdown_menu_content_in_grid_global = cinerama_edge_options()->getOptionValue('wide_dropdown_menu_content_in_grid');

        if ($wide_dropdown_menu_in_grid === 'yes') {
            $classes[] = 'edgtf-wide-dropdown-menu-in-grid';
        } else if (!empty($wide_dropdown_menu_in_grid_meta) && $wide_dropdown_menu_content_in_grid === 'yes' || $wide_dropdown_menu_content_in_grid_global === 'yes') {
            $classes[] = 'edgtf-wide-dropdown-menu-content-in-grid';
        }

        return $classes;
    }

    add_filter('body_class', 'cinerama_edge_wide_menu_body_class');
}