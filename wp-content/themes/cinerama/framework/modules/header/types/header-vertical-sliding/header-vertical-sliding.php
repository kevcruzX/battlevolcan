<?php
namespace CineramaEdgeNamespace\Modules\Header\Types;

use CineramaEdgeNamespace\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Vertical layout and option
 *
 * Class HeaderVertical
 */
class HeaderVerticalSliding extends HeaderType {
	protected $mobileHeaderHeight;
	
	public function __construct() {
		$this->slug = 'header-vertical-sliding';
		
		if ( ! is_admin() ) {
			$this->mobileHeaderHeight = cinerama_edge_set_default_mobile_menu_height_for_header_types();
			
			add_action( 'wp', array( $this, 'setHeaderHeightProps' ) );
			
			add_filter( 'cinerama_edge_filter_js_global_variables', array( $this, 'getGlobalJSVariables' ) );
			add_filter( 'cinerama_edge_filter_per_page_js_vars', array( $this, 'getPerPageJSVariables' ) );
		}
	}
	
	/**
	 * Loads template for header type
	 *
	 * @param array $parameters associative array of variables to pass to template
	 */
	public function loadTemplate( $parameters = array() ) {
		$parameters['holder_class'] = cinerama_edge_vertical_sliding_header_holder_class();
		$parameters['vertical_sliding_icon_class'] = cinerama_edge_get_vertical_sliding_header_icon_class();
		
		$parameters = apply_filters( 'cinerama_edge_filter_header_vertical_sliding_parameters', $parameters );
		
		cinerama_edge_get_module_template_part( 'templates/' . $this->slug, $this->moduleName . '/types/' . $this->slug, '', $parameters );
	}
	
	/**
	 * Sets header height properties after WP object is set up
	 */
	public function setHeaderHeightProps() {
		$this->mobileHeaderHeight = $this->calculateMobileHeaderHeight();
	}
	
	/**
	 * Returns total height of transparent parts of header
	 *
	 * @return mixed
	 */
	public function calculateHeightOfTransparency() {
		$menuAreaTransparent = false;
		
		if ( is_404() ) {
			$menuAreaTransparent = true;
		}
		
		$transparencyHeight = 0;
		
		if ( $menuAreaTransparent ) {
			$transparencyHeight = $this->mobileHeaderHeight;
		}
		
		return $transparencyHeight;
	}
	
	/**
	 * Returns height of header parts that are totaly transparent
	 *
	 * @return mixed
	 */
	public function calculateHeightOfCompleteTransparency() {
		return 0;
	}
	
	/**
	 * Returns header height
	 *
	 * @return mixed
	 */
	public function calculateHeaderHeight() {
		return 0;
	}
	
	/**
	 * Returns total height of mobile header
	 *
	 * @return int|string
	 */
	public function calculateMobileHeaderHeight() {
		$mobileHeaderHeight = $this->mobileHeaderHeight;
		
		return $mobileHeaderHeight;
	}
	
	/**
	 * Returns global js variables of header
	 *
	 * @param $globalVariables
	 *
	 * @return int|string
	 */
	public function getGlobalJSVariables( $globalVariables ) {
		$globalVariables['edgtfLogoAreaHeight']     = 0;
		$globalVariables['edgtfMenuAreaHeight']     = 0;
		$globalVariables['edgtfMobileHeaderHeight'] = $this->mobileHeaderHeight;
		
		return $globalVariables;
	}
	
	/**
	 * Returns per page js variables of header
	 *
	 * @param $perPageVars
	 *
	 * @return int|string
	 */
	public function getPerPageJSVariables( $perPageVars ) {
		$perPageVars['edgtfHeaderTransparencyHeight'] = 0;
        $perPageVars['edgtfHeaderVerticalWidth'] = 90;
		
		return $perPageVars;
	}
}