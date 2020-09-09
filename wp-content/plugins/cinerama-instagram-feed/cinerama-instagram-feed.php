<?php
/*
Plugin Name: Cinerama Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Edge Themes
Version: 1.0
*/
define('CINERAMA_INSTAGRAM_FEED_VERSION', '1.0');
define('CINERAMA_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('CINERAMA_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));

include_once 'load.php';

if(!function_exists('cinerama_instagram_feed_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function cinerama_instagram_feed_text_domain() {
        load_plugin_textdomain('cinerama-instagram-feed', false, CINERAMA_INSTAGRAM_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'cinerama_instagram_feed_text_domain');
}

if ( ! function_exists( 'cinerama_instagram_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function cinerama_instagram_theme_installed() {
		return defined( 'EDGE_ROOT' );
	}
}
