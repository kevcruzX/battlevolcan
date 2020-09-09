<?php
namespace CineramaCore\CPT\Shortcodes\LightboxImageGallery;

use CineramaCore\Lib;

class LightboxImageGallery implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_lightbox_image_gallery';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Lightbox Image Gallery', 'cinerama-core' ),
					'base'     => $this->getBase(),
					'category' => esc_html__( 'by CINERAMA', 'cinerama-core' ),
					'icon'     => 'icon-wpb-lightbox-image-gallery extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'Two', 'cinerama-core' )   => 'two',
								esc_html__( 'Three', 'cinerama-core' ) => 'three',
								esc_html__( 'Four', 'cinerama-core' )  => 'four',
								esc_html__( 'Five', 'cinerama-core' )  => 'five',
								esc_html__( 'Six', 'cinerama-core' )   => 'six'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'       => 'param_group',
							'param_name' => 'items',
							'heading'    => esc_html__( 'Link Items', 'cinerama-core' ),
							'params'     => array(
								array(
									'type'       => 'textfield',
									'param_name' => 'title',
									'heading'    => esc_html__( 'Title', 'cinerama-core' ),
								),
								array(
									'type'        => 'attach_image',
									'param_name'  => 'image',
									'heading'     => esc_html__( 'Image', 'cinerama-core' ),
									'description' => esc_html__( 'Select image from media library', 'cinerama-core' )
								),
								array(
									'type'        => 'textfield',
									'param_name'  => 'link',
									'heading'     => esc_html__( 'Lightbox Link', 'cinerama-core' ),
									'description' => esc_html__( 'If you leave empty this field lightbox link will be the same as image url', 'cinerama-core' )
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
			'number_of_columns'   => 'three',
			'space_between_items' => 'normal',
			'items'               => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['items']          = json_decode( urldecode( $params['items'] ), true );
		
		$html = cinerama_core_get_shortcode_module_template_part( 'templates/lightbox-image-gallery', 'lightbox-image-gallery', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'edgtf-' . $params['number_of_columns'] . '-columns' : 'edgtf-' . $args['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'edgtf-' . $params['space_between_items'] . '-space' : 'edgtf-' . $args['space_between_items'] . '-space';
		
		return implode( ' ', $holderClasses );
	}
}