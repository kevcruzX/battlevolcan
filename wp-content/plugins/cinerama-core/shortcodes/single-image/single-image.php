<?php
namespace CineramaCore\CPT\Shortcodes\SingleImage;

use CineramaCore\Lib;

class SingleImage implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_single_image';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Single Image', 'cinerama-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by CINERAMA', 'cinerama-core' ),
					'icon'                      => 'icon-wpb-single-image extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'cinerama-core' ),
							'description' => esc_html__( 'Select image from media library', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size',
							'heading'     => esc_html__( 'Image Size', 'cinerama-core' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'cinerama-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_alignment',
							'heading'    => esc_html__( 'Image Alignment', 'cinerama-core' ),
							'value'      => array(
								esc_html__( 'Left', 'cinerama-core' )    => 'left',
								esc_html__( 'Center', 'cinerama-core' )  => 'center',
								esc_html__( 'Right', 'cinerama-core' )   => 'right'
							)
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_image_border',
							'heading'     => esc_html__( 'Enable Image Border', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_image_shadow',
							'heading'     => esc_html__( 'Enable Image Shadow', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'image_behavior',
							'heading'    => esc_html__( 'Image Behavior', 'cinerama-core' ),
							'value'      => array(
								esc_html__( 'None', 'cinerama-core' )             => '',
								esc_html__( 'Open Lightbox', 'cinerama-core' )    => 'lightbox',
								esc_html__( 'Open Custom Link', 'cinerama-core' ) => 'custom-link',
								esc_html__( 'Zoom', 'cinerama-core' )             => 'zoom',
								esc_html__( 'Grayscale', 'cinerama-core' )        => 'grayscale',
								esc_html__( 'Moving on Hover', 'cinerama-core' )  => 'moving'
							)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'custom_link',
							'heading'    => esc_html__( 'Custom Link', 'cinerama-core' ),
							'dependency' => Array( 'element' => 'image_behavior', 'value' => array( 'custom-link' ) )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'custom_link_target',
							'heading'    => esc_html__( 'Custom Link Target', 'cinerama-core' ),
							'value'      => array_flip( cinerama_edge_get_link_target_array() ),
							'dependency' => Array( 'element' => 'image_behavior', 'value' => array( 'custom-link' ) )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'image'               => '',
			'image_size'          => 'full',
			'image_alignment'     => 'left',
			'enable_image_border' => 'no',
			'enable_image_shadow' => 'no',
			'image_behavior'      => '',
			'custom_link'         => '',
			'custom_link_target'  => '_self'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']     = $this->getHolderClasses( $params );
		$params['holder_styles']      = $this->getHolderStyles( $params );
		$params['image']              = $this->getImage( $params );
		$params['image_size']         = $this->getImageSize( $params['image_size'] );
		$params['image_behavior']     = ! empty( $params['image_behavior'] ) ? $params['image_behavior'] : $args['image_behavior'];
		$params['custom_link_target'] = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : $args['custom_link_target'];

		$html = cinerama_core_get_shortcode_module_template_part( 'templates/single-image', 'single-image', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['enable_image_border'] === 'yes' ? 'edgtf-has-border' : '';
		$holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'edgtf-has-shadow' : '';
		$holderClasses[] = ! empty( $params['image_behavior'] ) ? 'edgtf-image-behavior-' . $params['image_behavior'] : '';
		$holderClasses[] = ! empty( $params['image_alignment'] ) ? 'edgtf-image-align-' . $params['image_alignment'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['image'] ) && $params['image_behavior'] === 'moving' ) {
			$image_original = wp_get_attachment_image_src( $params['image'], 'full' );
			
			$styles[] = 'background-image: url(' . $image_original[0] . ')';
		}
		
		return implode( ';', $styles );
	}

	private function getImage( $params ) {
		$image = array();
		
		if ( ! empty( $params['image'] ) ) {
			$id = $params['image'];

			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
			$image['caption']  = '';

			if ($image_object = get_post($id)) {
				$image['caption'] = $image_object->post_excerpt;
			}
		}
		
		return $image;
	}

	private function getImageSize( $image_size ) {
		$image_size = trim( $image_size );
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
			return $image_size;
		} elseif ( ! empty( $matches[0] ) ) {
			return array(
				$matches[0][0],
				$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}
}