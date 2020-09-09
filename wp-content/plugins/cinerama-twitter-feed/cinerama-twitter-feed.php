<?php
/*
Plugin Name: Cinerama Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Edge Themes
Version: 1.0
*/

define( 'CINERAMA_TWITTER_FEED_VERSION', '1.0' );
define( 'CINERAMA_TWITTER_ABS_PATH', dirname( __FILE__ ) );
define( 'CINERAMA_TWITTER_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'CINERAMA_TWITTER_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'CINERAMA_TWITTER_ASSETS_PATH', CINERAMA_TWITTER_ABS_PATH . '/assets' );
define( 'CINERAMA_TWITTER_ASSETS_URL_PATH', CINERAMA_TWITTER_URL_PATH . 'assets' );
define( 'CINERAMA_TWITTER_SHORTCODES_PATH', CINERAMA_TWITTER_ABS_PATH . '/shortcodes' );
define( 'CINERAMA_TWITTER_SHORTCODES_URL_PATH', CINERAMA_TWITTER_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'cinerama_twitter_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function cinerama_twitter_theme_installed() {
		return defined( 'EDGE_ROOT' );
	}
}

if ( ! function_exists( 'cinerama_twitter_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function cinerama_twitter_feed_text_domain() {
		load_plugin_textdomain( 'cinerama-twitter-feed', false, CINERAMA_TWITTER_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'cinerama_twitter_feed_text_domain' );
}