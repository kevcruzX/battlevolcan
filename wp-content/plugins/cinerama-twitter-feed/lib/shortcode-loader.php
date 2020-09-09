<?php
namespace CineramaTwitter\Lib;

/**
 * Class ShortcodeLoader
 * @package TwitterShortcodeLoader\Lib
 */
class ShortcodeLoader {
    /**
     * @var private instance of current class
     */
    private static $instance;
    /**
     * @var array
     */
    private $loadedShortcodes = array();

    /**
     * Private constuct because of Singletone
     */
    private function __construct() {}

    /**
     * Private sleep because of Singletone
     */
    private function __wakeup() {}

    /**
     * Private clone because of Singletone
     */
    private function __clone() {}

    /**
     * Returns current instance of class
     * @return ShortcodeLoader
     */
    public static function getInstance() {
        if(self::$instance == null) {
            return new self;
        }

        return self::$instance;
    }

    /**
     * Adds new shortcode. Object that it takes must implement ShortcodeInterface
     * @param ShortcodeInterface $shortcode
     */
    private function addShortcode(ShortcodeInterface $shortcode) {
        if(!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
            $this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
        }
    }

    /**
     * Adds all shortcodes.
     *
     * @see ShortcodeLoader::addShortcode()
     */
    private function addShortcodes() {
	    $shortcodes_class_name = apply_filters('cinerama_twitter_filter_add_vc_shortcode', $shortcodes_class_name = array());
		sort($shortcodes_class_name);
		if(!empty($shortcodes_class_name)) {
			foreach($shortcodes_class_name as $shortcode_class_name) {
				$this->addShortcode(new $shortcode_class_name);
			}
		}
    }

    /**
     * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
     * of each shortcode object
     */
    public function load() {
    	if(cinerama_twitter_theme_installed()) {
		    $this->addShortcodes();
		
		    foreach ($this->loadedShortcodes as $shortcode) {
			    add_shortcode($shortcode->getBase(), array($shortcode, 'render'));
		    }
	    }
    }
}