<?php
namespace CineramaCore\CPT\Shortcodes\HorizontalTimeline;

use CineramaCore\Lib;

class HorizontalTimeline implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_horizontal_timeline';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Horizontal Timeline', 'cinerama-core' ),
					'base'                    => $this->base,
					'category'                => esc_html__( 'by CINERAMA', 'cinerama-core' ),
					'icon'                    => 'icon-wpb-horizontal-timeline extended-custom-icon',
					'as_parent'               => array( 'only' => 'edgtf_horizontal_timeline_item' ),
					'js_view'                 => 'VcColumnView',
					'content_element'         => true,
					'show_settings_on_create' => false,
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'timeline_format',
							'heading'     => esc_html__( 'Timeline displays?', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'Only Years', 'cinerama-core' )             => 'Y',
								esc_html__( 'Years and Months', 'cinerama-core' )       => 'M Y',
								esc_html__( 'Years, Months and Days', 'cinerama-core' ) => 'M d, \'y',
								esc_html__( 'Months and Days', 'cinerama-core' )        => 'M d'
							),
							'save_always' => true,
							'admin_label' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'distance',
							'heading'     => esc_html__( 'Minimal Distance Between Dates?', 'cinerama-core' ),
							'description' => esc_html__( 'Default value is 60', 'cinerama-core' ),
							'admin_label' => true
						)
					)
				)
			);
		}
	}
	
	/**
	 * Renders HTML for product list shortcode
	 *
	 * @param array $atts
	 * @param null  $content
	 *
	 * @return string
	 */
	public function render( $atts, $content = null ) {
		$args   = array(
			'timeline_format' => 'Y',
			'distance'        => '60'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content'] = $content;
		$params['dates']   = $this->getDates($content);
		
		$html = cinerama_core_get_shortcode_module_template_part( 'templates/horizontal-timeline-holder', 'horizontal-timeline', '', $params );
		
		return $html;
	}
	
	private function getDates( $content ) {
		$datesArray = array();
		
		preg_match_all( '/date="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		if ( isset( $matches[0] ) ) {
			$dates = $matches[0];
			
			if ( is_array( $dates ) && count( $dates ) ) {
				foreach ( $dates as $date ) {
					preg_match( '/date="([^\"]+)"/i', $date[0], $dateMatches, PREG_OFFSET_CAPTURE );
					$date = new \DateTime( $dateMatches[1][0] );
					
					$currentDate = array(
						'formatted' => $dateMatches[1][0],
						'timestamp' => $date->getTimestamp()
					);
					
					$datesArray[] = $currentDate;
				}
			}
		}
		
		return $datesArray;
	}
}