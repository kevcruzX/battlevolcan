<?php
namespace CineramaCore\CPT\Shortcodes\GoogleMap;

use CineramaCore\Lib;

class GoogleMap implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_google_map';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Google Map', 'cinerama-core' ),
					'base'                    => $this->base,
					'category'                => esc_html__( 'by CINERAMA', 'cinerama-core' ),
					'icon'                    => 'icon-wpb-google-map extended-custom-icon',
					'show_settings_on_create' => true,
					'params'                  => array(
						array(
							'type'       => 'textfield',
							'param_name' => 'address1',
							'heading'    => esc_html__( 'Address 1', 'cinerama-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'address2',
							'heading'    => esc_html__( 'Address 2', 'cinerama-core' ),
							'dependency' => Array( 'element' => 'address1', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'address3',
							'heading'    => esc_html__( 'Address 3', 'cinerama-core' ),
							'dependency' => Array( 'element' => 'address2', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'address4',
							'heading'    => esc_html__( 'Address 4', 'cinerama-core' ),
							'dependency' => Array( 'element' => 'address3', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'address5',
							'heading'    => esc_html__( 'Address 5', 'cinerama-core' ),
							'dependency' => Array( 'element' => 'address4', 'not_empty' => true )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'snazzy_map_style',
							'heading'     => esc_html__( 'Snazzy Map Style', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false ) ),
							'description' => esc_html__( 'Enabling this option will set predefined snazzy map style', 'cinerama-core' )
						),
						array(
							'type'        => 'textarea',
							'param_name'  => 'snazzy_map_code',
							'heading'     => esc_html__( 'Snazzy Map Code', 'cinerama-core' ),
							'description' => sprintf( esc_html__( 'Fill code from snazzy map site %s to add predefined style for your google map', 'cinerama-core' ), '<a href="https://snazzymaps.com/" target="_blank">https://snazzymaps.com/</a>' ),
							'dependency'  => Array( 'element' => 'snazzy_map_style', 'value' => array( 'yes' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'custom_map_style',
							'heading'     => esc_html__( 'Custom Map Style', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false ) ),
							'description' => esc_html__( 'Enabling this option will allow Map editing', 'cinerama-core' ),
							'dependency'  => Array( 'element' => 'snazzy_map_style', 'value' => array( 'no' ) )
						),
						array(
							'type'        => 'colorpicker',
							'param_name'  => 'color_overlay',
							'heading'     => esc_html__( 'Color Overlay', 'cinerama-core' ),
							'description' => esc_html__( 'Choose a Map color overlay', 'cinerama-core' ),
							'dependency'  => Array( 'element' => 'custom_map_style', 'value' => array( 'yes' ) )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'saturation',
							'heading'     => esc_html__( 'Saturation', 'cinerama-core' ),
							'description' => esc_html__( 'Choose a level of saturation (-100 = least saturated, 100 = most saturated)', 'cinerama-core' ),
							'dependency'  => Array( 'element' => 'custom_map_style', 'value' => array( 'yes' ) )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'lightness',
							'heading'     => esc_html__( 'Lightness', 'cinerama-core' ),
							'description' => esc_html__( 'Choose a level of lightness (-100 = darkest, 100 = lightest)', 'cinerama-core' ),
							'dependency'  => Array( 'element' => 'custom_map_style', 'value' => array( 'yes' ) )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'pin',
							'heading'     => esc_html__( 'Pin', 'cinerama-core' ),
							'description' => esc_html__( 'Select a pin image to be used on Google Map', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'zoom',
							'heading'     => esc_html__( 'Map Zoom', 'cinerama-core' ),
							'description' => esc_html__( 'Enter a zoom factor for Google Map (0 = whole worlds, 19 = individual buildings)', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'scroll_wheel',
							'heading'     => esc_html__( 'Zoom Map on Mouse Wheel', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false ) ),
							'description' => esc_html__( 'Enabling this option will allow users to zoom in on Map using mouse wheel', 'cinerama-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'map_height',
							'heading'    => esc_html__( 'Map Height', 'cinerama-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'address1'         => '',
			'address2'         => '',
			'address3'         => '',
			'address4'         => '',
			'address5'         => '',
			'snazzy_map_style' => 'no',
			'snazzy_map_code'  => '',
			'custom_map_style' => 'no',
			'color_overlay'    => '#393939',
			'saturation'       => '-100',
			'lightness'        => '-60',
			'zoom'             => '12',
			'pin'              => '',
			'scroll_wheel'     => 'no',
			'map_height'       => '600'
		);
		$params = shortcode_atts( $args, $atts );
		
		$rand_id = mt_rand( 100000, 3000000 );
		
		$params['map_data'] = $this->getMapDate( $params, $rand_id );
		$params['map_id']   = 'edgtf-map-' . $rand_id;
		
		$html = cinerama_core_get_shortcode_module_template_part( 'templates/google-map-template', 'google-map', '', $params );
		
		return $html;
	}
	
	private function getMapDate( $params, $id ) {
		$map_data = array();
		
		$addresses_array = array();
		if ( $params['address1'] != '' ) {
			array_push( $addresses_array, esc_attr( $params['address1'] ) );
		}
		if ( $params['address2'] != '' ) {
			array_push( $addresses_array, esc_attr( $params['address2'] ) );
		}
		if ( $params['address3'] != '' ) {
			array_push( $addresses_array, esc_attr( $params['address3'] ) );
		}
		if ( $params['address4'] != '' ) {
			array_push( $addresses_array, esc_attr( $params['address4'] ) );
		}
		if ( $params['address5'] != '' ) {
			array_push( $addresses_array, esc_attr( $params['address5'] ) );
		}
		
		if ( $params['pin'] != "" ) {
			$map_pin = wp_get_attachment_image_src( $params['pin'], 'full', true );
			$map_pin = $map_pin[0];
		} else {
			$map_pin = get_template_directory_uri() . "/assets/img/pin.png";
		}
		
		$map_data[] = "data-addresses='[\"" . implode( '","', $addresses_array ) . "\"]'";
		$map_data[] = 'data-custom-map-style=' . $params['custom_map_style'];
		$map_data[] = 'data-color-overlay=' . $params['color_overlay'];
		$map_data[] = 'data-saturation=' . $params['saturation'];
		$map_data[] = 'data-lightness=' . $params['lightness'];
		$map_data[] = 'data-zoom=' . $params['zoom'];
		$map_data[] = 'data-pin=' . $map_pin;
		$map_data[] = 'data-unique-id=' . $id;
		$map_data[] = 'data-scroll-wheel=' . $params['scroll_wheel'];
		$map_data[] = 'data-height=' . $params['map_height'];
		$map_data[] = $params['snazzy_map_style'] == 'yes' ? 'data-snazzy-map-style=yes' : '';
		
		return implode( ' ', $map_data );
	}
}
