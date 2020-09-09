<?php
namespace CineramaCore\CPT\Shortcodes\LightboxImageCarousel;

use CineramaCore\Lib;

class LightboxImageCarousel implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_lightbox_image_carousel';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Lightbox Image Carousel', 'cinerama-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by CINERAMA', 'cinerama-core' ),
					'icon'     => 'icon-wpb-lightbox-image-carousel extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'carousel_autoplay',
							'heading'     => esc_html__( 'Enable Carousel Autoplay', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'carousel_speed',
							'heading'     => esc_html__( 'Slide Duration', 'cinerama-core' ),
							'description' => esc_html__( 'Default value is 4000 (ms)', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'carousel_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'cinerama-core' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 800.', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'carousel_navigation',
							'heading'     => esc_html__( 'Enable Carousel Navigation Arrows', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_custom_navigation',
							'heading'     => esc_html__( 'Enable Custom Carousel Navigation Arrows', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false, false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'carousel_navigation', 'value' => array( 'yes' ) )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'skin',
							'heading'    => esc_html__( 'Skin', 'cinerama-core' ),
							'value'      => array(
								esc_html__( 'Default', 'cinerama-core' ) => '',
								esc_html__( 'Light', 'cinerama-core' )   => 'light'
							)
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'carousel_pagination',
							'heading'     => esc_html__( 'Enable Carousel Pagination', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'param_group',
							'param_name' => 'carousel_items',
							'heading'    => esc_html__( 'Link Items', 'cinerama-core' ),
							'params'     => array(
								array(
									'type'       => 'textfield',
									'param_name' => 'title',
									'heading'    => esc_html__( 'Slide Title', 'cinerama-core' ),
								),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'image',
									'heading'     => esc_html__( 'Slide Image', 'cinerama-core' ),
									'description' => esc_html__( 'Select image from media library', 'cinerama-core' )
								),
								array(
									'type'       => 'textfield',
									'param_name' => 'link',
									'heading'    => esc_html__( 'Slide Lightbox Link', 'cinerama-core' )
								),
								array(
									'type'       => 'dropdown',
									'param_name' => 'is_video_link',
									'heading'    => esc_html__( 'Lightbox Link is Video', 'cinerama-core' ),
									'value'      => array_flip( cinerama_edge_get_yes_no_select_array( false ) )
								)
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'carousel_items'           => '',
			'carousel_autoplay'        => 'yes',
			'carousel_speed'           => '4000',
			'carousel_speed_animation' => '800',
			'carousel_padding'         => 'no',
			'carousel_navigation'      => 'no',
			'enable_custom_navigation' => 'no',
			'skin'                     => '',
			'carousel_pagination'      => 'no'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['carousel_items'] = json_decode( urldecode( $params['carousel_items'] ), true );
		$params['carousel_data']  = $this->getSliderData( $params, $args );
		$params['holder_classes']         = $this->getHolderClasses( $params, $args );
		
		$html = cinerama_core_get_shortcode_module_template_part( 'templates/lightbox-image-carousel', 'lightbox-image-carousel', '', $params );
		
		return $html;
	}
	
	private function getSliderData( $params, $args ) {
		$data = array();
		
		$data['data-number-of-items']             = '1';
		$data['data-enable-loop']                 = 'yes';
		$data['data-enable-autoplay']             = ! empty( $params['carousel_autoplay'] ) ? $params['carousel_autoplay'] : $args['carousel_autoplay'];
		$data['data-enable-autoplay-hover-pause'] = 'no';
		$data['data-slider-speed']                = ! empty( $params['carousel_speed'] ) ? $params['carousel_speed'] : $args['carousel_speed'];
		$data['data-slider-speed-animation']      = ! empty( $params['carousel_speed_animation'] ) ? $params['carousel_speed_animation'] : $args['carousel_speed_animation'];
		$data['data-enable-center']               = 'yes';
		$data['data-slider-custom-padding']       = 'yes';
		$data['data-enable-navigation']           = ! empty( $params['carousel_navigation'] ) ? $params['carousel_navigation'] : $args['carousel_navigation'];
		$data['data-enable-pagination']           = ! empty( $params['carousel_pagination'] ) ? $params['carousel_pagination'] : $args['carousel_pagination'];
		
		return $data;
	}
	
	public function getHolderClasses( $params, $args ) {
		$classes = array();
		
		$classes[] = ! empty( $params['skin'] ) ? 'edgtf-' . $params['skin'] . '-skin' : '';
		$classes[] = $params['carousel_navigation'] === 'yes' && $params['enable_custom_navigation'] === 'yes' ? 'edgtf-owl-custom-nav' : '';
		
		return implode( ' ', $classes );
	}
	
}