<?php

namespace CineramaCore\CPT\Shortcodes\HorizontalTimeline;

use CineramaCore\Lib;

class HorizontalTimelineItem implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_horizontal_timeline_item';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'            => esc_html__( 'Elated Horizontal Timeline Item', 'cinerama-core' ),
					'base'            => $this->base,
					'category'        => esc_html__( 'by ELATED', 'cinerama-core' ),
					'icon'            => 'icon-wpb-horizontal-timeline-item extended-custom-icon',
					'as_child'        => array( 'only' => 'edgtf_horizontal_timeline' ),
					'as_parent'       => array( 'except' => 'vc_row, vc_accordion' ),
					'content_element' => true,
					'js_view'         => 'VcColumnView',
					'params'          => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'date',
							'heading'     => esc_html__( 'Timeline Date', 'cinerama-core' ),
							'description' => esc_html__( 'Enter date in format dd/mm/yyyy.', 'cinerama-core' )
						),
						array(
							'type'       => 'attach_image',
							'param_name' => 'content_image',
							'heading'    => esc_html__( 'Content Image', 'cinerama-core' )
						)
					)
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args = array(
			'date'          => '23/02/2017',
			'content_image' => ''
		);
		$params       = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params );
		$params['date']           = ! empty( $atts['date'] ) ? $atts['date'] : $args['date'];
		$params['content']        = $content;
		
		$html = cinerama_core_get_shortcode_module_template_part( 'templates/horizontal-timeline-item', 'horizontal-timeline', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['content_image'] ) ? 'edgtf-timeline-has-image' : 'edgtf-timeline-no-image';
		
		return implode( ' ', $holderClasses );
	}
}