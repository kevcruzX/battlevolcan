<?php
namespace CineramaCore\CPT\Shortcodes\Dropcaps;

use CineramaCore\Lib;

class Dropcaps implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_dropcaps';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'type'             => '',
			'color'            => '',
			'background_color' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['letter']         = $content;
		$params['dropcaps_style'] = $this->getDropcapsStyles( $params );
		$params['dropcaps_class'] = $this->getDropcapsClass( $params );
		
		$html = cinerama_core_get_shortcode_module_template_part( 'templates/dropcaps-template', 'dropcaps', '', $params );
		
		return $html;
	}
	
	private function getDropcapsStyles( $params ) {
		$styles = array();
		
		if ( $params['color'] !== '' ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		if ( $params['type'] !== 'normal' && $params['background_color'] !== '' ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getDropcapsClass( $params ) {
		return ! empty( $params['type'] ) ? 'edgtf-' . $params['type'] : '';
	}
}