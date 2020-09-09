<?php
namespace CineramaCore\CPT\Shortcodes\Highlight;

use CineramaCore\Lib;

class Highlight implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_highlight';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'color'            => '',
			'background_color' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content']         = $content;
		$params['highlight_style'] = $this->getHighlightStyles( $params );
		
		$html = cinerama_core_get_shortcode_module_template_part( 'templates/highlight-template', 'highlight', '', $params );
		
		return $html;
	}
	
	private function getHighlightStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		return implode( ';', $styles );
	}
}