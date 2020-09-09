<?php

namespace CineramaCore\Lib;

/**
 * interface PostTypeInterface
 * @package CineramaCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}