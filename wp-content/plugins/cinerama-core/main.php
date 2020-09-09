<?php
/*
Plugin Name: Cinerama Core
Description: Plugin that adds all post types needed by our theme
Author: Edge Themes
Version: 1.1
*/

require_once 'load.php';

add_action('after_setup_theme', array(CineramaCore\CPT\PostTypesRegister::getInstance(), 'register'));

if (!function_exists('cinerama_core_activation')) {
    /**
     * Triggers when plugin is activated. It calls flush_rewrite_rules
     * and defines cinerama_edge_action_core_on_activate action
     */
    function cinerama_core_activation() {
        do_action('cinerama_edge_action_core_on_activate');

        CineramaCore\CPT\PostTypesRegister::getInstance()->register();
        flush_rewrite_rules();
    }

    register_activation_hook(__FILE__, 'cinerama_core_activation');
}

if (!function_exists('cinerama_core_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function cinerama_core_text_domain() {
        load_plugin_textdomain('cinerama-core', false, CINERAMA_CORE_REL_PATH . '/languages');
    }

    add_action('plugins_loaded', 'cinerama_core_text_domain');
}

if (!function_exists('cinerama_core_version_class')) {
    /**
     * Adds plugins version class to body
     *
     * @param $classes
     *
     * @return array
     */
    function cinerama_core_version_class($classes) {
        $classes[] = 'cinerama-core-' . CINERAMA_CORE_VERSION;

        return $classes;
    }

    add_filter('body_class', 'cinerama_core_version_class');
}

if (!function_exists('cinerama_core_theme_installed')) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function cinerama_core_theme_installed() {
        return defined('EDGE_ROOT');
    }
}

if (!function_exists('cinerama_core_is_woocommerce_installed')) {
    /**
     * Function that checks if woocommerce is installed
     * @return bool
     */
    function cinerama_core_is_woocommerce_installed() {
        return function_exists('is_woocommerce');
    }
}

if (!function_exists('cinerama_core_is_woocommerce_integration_installed')) {
    //is Edge Woocommerce Integration installed?
    function cinerama_core_is_woocommerce_integration_installed() {
        return defined('CINERAMA_CHECKOUT_INTEGRATION');
    }
}

if (!function_exists('cinerama_core_is_revolution_slider_installed')) {
    function cinerama_core_is_revolution_slider_installed() {
        return class_exists('RevSliderFront');
    }
}

if (!function_exists('cinerama_core_is_wpml_installed')) {
    /**
     * Function that checks if WPML plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function cinerama_core_is_wpml_installed() {
        return defined('ICL_SITEPRESS_VERSION');
    }
}

if (!function_exists('cinerama_core_theme_menu')) {
    /**
     * Function that generates admin menu for options page.
     * It generates one admin page per options page.
     */
    function cinerama_core_theme_menu() {
        if (cinerama_core_theme_installed()) {

            global $cinerama_edge_global_Framework;
            cinerama_edge_init_theme_options();

            $page_hook_suffix = add_menu_page(
                esc_html__('Cinerama Options', 'cinerama-core'), // The value used to populate the browser's title bar when the menu page is active
                esc_html__('Cinerama Options', 'cinerama-core'), // The text of the menu in the administrator's sidebar
                'administrator',                            // What roles are able to access the menu
                EDGE_OPTIONS_SLUG,            // The ID used to bind submenu items to this menu
                array($cinerama_edge_global_Framework->getSkin(), 'renderOptions'), // The callback function used to render this menu
                $cinerama_edge_global_Framework->getSkin()->getSkinURI() . '/assets/img/admin-logo-icon.png', // Icon For menu Item
                100                                                                                            // Position
            );

            foreach ($cinerama_edge_global_Framework->edgtOptions->adminPages as $key => $value) {
                $slug = "";

                if (!empty($value->slug)) {
                    $slug = "_tab" . $value->slug;
                }

                $subpage_hook_suffix = add_submenu_page(
                    EDGE_OPTIONS_SLUG,
                    esc_html__('Cinerama Options - ', 'cinerama-core') . $value->title, // The value used to populate the browser's title bar when the menu page is active
                    $value->title,                                                 // The text of the menu in the administrator's sidebar
                    'administrator',                                               // What roles are able to access the menu
                    EDGE_OPTIONS_SLUG . $slug,                       // The ID used to bind submenu items to this menu
                    array($cinerama_edge_global_Framework->getSkin(), 'renderOptions')
                );

                add_action('admin_print_scripts-' . $subpage_hook_suffix, 'cinerama_edge_enqueue_admin_scripts');
                add_action('admin_print_styles-' . $subpage_hook_suffix, 'cinerama_edge_enqueue_admin_styles');
            };

            add_action('admin_print_scripts-' . $page_hook_suffix, 'cinerama_edge_enqueue_admin_scripts');
            add_action('admin_print_styles-' . $page_hook_suffix, 'cinerama_edge_enqueue_admin_styles');
        }
    }

    add_action('admin_menu', 'cinerama_core_theme_menu');
}

if (!function_exists('cinerama_core_theme_menu_backup_options')) {
    /**
     * Function that generates admin menu for options page.
     * It generates one admin page per options page.
     */
    function cinerama_core_theme_menu_backup_options() {
        if (cinerama_core_theme_installed()) {
            global $cinerama_edge_global_Framework;

            $slug = "_backup_options";
            $page_hook_suffix = add_submenu_page(
                EDGE_OPTIONS_SLUG,
                esc_html__('Cinerama Options - Backup Options', 'cinerama-core'), // The value used to populate the browser's title bar when the menu page is active
                esc_html__('Backup Options', 'cinerama-core'),                // The text of the menu in the administrator's sidebar
                'administrator',                                             // What roles are able to access the menu
                EDGE_OPTIONS_SLUG . $slug,                     // The ID used to bind submenu items to this menu
                array($cinerama_edge_global_Framework->getSkin(), 'renderBackupOptions')
            );

            add_action('admin_print_scripts-' . $page_hook_suffix, 'cinerama_edge_enqueue_admin_scripts');
            add_action('admin_print_styles-' . $page_hook_suffix, 'cinerama_edge_enqueue_admin_styles');
        }
    }

    add_action('admin_menu', 'cinerama_core_theme_menu_backup_options');
}

if (!function_exists('cinerama_core_theme_admin_bar_menu_options')) {
    /**
     * Add a link to the WP Toolbar
     */
    function cinerama_core_theme_admin_bar_menu_options($wp_admin_bar) {
		if ( cinerama_core_theme_installed() && current_user_can( 'administrator' ) ) {
			global $cinerama_edge_global_Framework;

			$args = array(
				'id' => 'cinerama-admin-bar-options',
				'title' => sprintf('<span class="ab-icon dashicons-before dashicons-admin-generic"></span> %s', esc_html__('Cinerama Options', 'cinerama-core')),
				'href' => esc_url(admin_url('admin.php?page=' . EDGE_OPTIONS_SLUG))
			);

			$wp_admin_bar->add_node($args);

			foreach ($cinerama_edge_global_Framework->edgtOptions->adminPages as $key => $value) {
				$suffix = !empty($value->slug) ? '_tab' . $value->slug : '';

				$args = array(
					'id' => 'cinerama-admin-bar-options-' . $suffix,
					'title' => $value->title,
					'parent' => 'cinerama-admin-bar-options',
					'href' => esc_url(admin_url('admin.php?page=' . EDGE_OPTIONS_SLUG . $suffix))
				);

				$wp_admin_bar->add_node($args);
			};
		}
    }

    add_action('admin_bar_menu', 'cinerama_core_theme_admin_bar_menu_options', 999);
}

if ( ! function_exists( 'cinerama_core_enqueue_our_prettyphoto_scripts_for_theme' ) ) {
	/**
	 * Function that includes our prettyphoto script
	 */
	function cinerama_core_enqueue_our_prettyphoto_scripts_for_theme() {
		
		if ( cinerama_core_theme_installed() && cinerama_edge_visual_composer_installed() ) {
			wp_deregister_script( 'prettyphoto' );
			wp_enqueue_script( 'prettyphoto', EDGE_ASSETS_ROOT . '/js/modules/plugins/jquery.prettyPhoto.js', array( 'jquery' ), false, true );
		}
	}
	
	add_action( 'cinerama_edge_action_enqueue_third_party_scripts', 'cinerama_core_enqueue_our_prettyphoto_scripts_for_theme' );
}
