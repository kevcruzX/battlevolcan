<?php
namespace CineramaCore\CPT\Shortcodes\ImageGallery;

use CineramaCore\Lib;

class ImageGallery implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_image_gallery';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Image Gallery', 'cinerama-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by CINERAMA', 'cinerama-core' ),
					'icon'                      => 'icon-wpb-image-gallery extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'cinerama-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'type',
							'heading'     => esc_html__( 'Gallery Type', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'Image Grid', 'cinerama-core' ) => 'grid',
								esc_html__( 'Masonry', 'cinerama-core' )    => 'masonry',
								esc_html__( 'Slider', 'cinerama-core' )     => 'slider',
								esc_html__( 'Carousel', 'cinerama-core' )   => 'carousel'
							),
							'save_always' => true,
							'admin_label' => true
						),
						array(
							'type'        => 'attach_images',
							'param_name'  => 'images',
							'heading'     => esc_html__( 'Images', 'cinerama-core' ),
							'description' => esc_html__( 'Select images from media library', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size',
							'heading'     => esc_html__( 'Image Size', 'cinerama-core' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'cinerama-core' )
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
								esc_html__( 'Grayscale', 'cinerama-core' )        => 'grayscale'
							)
						),
						array(
							'type'        => 'textarea',
							'param_name'  => 'custom_links',
							'heading'     => esc_html__( 'Custom Links', 'cinerama-core' ),
							'description' => esc_html__( 'Delimit links by comma', 'cinerama-core' ),
							'dependency'  => array( 'element' => 'image_behavior', 'value' => array( 'custom-link' ) )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'custom_link_target',
							'heading'    => esc_html__( 'Custom Link Target', 'cinerama-core' ),
							'value'      => array_flip( cinerama_edge_get_link_target_array() ),
							'dependency' => array( 'element' => 'image_behavior', 'value' => array( 'custom-link' ) )
						),
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
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'grid', 'masonry' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_visible_items',
							'heading'     => esc_html__( 'Number Of Visible Items', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'One', 'cinerama-core' )   => '1',
								esc_html__( 'Two', 'cinerama-core' )   => '2',
								esc_html__( 'Three', 'cinerama-core' ) => '3',
								esc_html__( 'Four', 'cinerama-core' )  => '4',
								esc_html__( 'Five', 'cinerama-core' )  => '5',
								esc_html__( 'Six', 'cinerama-core' )   => '6'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_loop',
							'heading'     => esc_html__( 'Enable Slider Loop', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_autoplay',
							'heading'     => esc_html__( 'Enable Slider Autoplay', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed',
							'heading'     => esc_html__( 'Slide Duration', 'cinerama-core' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'cinerama-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'slider_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'cinerama-core' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'cinerama-core' ),
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_padding',
							'heading'     => esc_html__( 'Enable Slider Padding', 'cinerama-core' ),
							'description' => esc_html__( 'Padding left and right on stage (can see neighbours).', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider' ) ),
							'group'       => esc_html__( 'Slider Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'slider', 'carousel' ) ),
							'group'       => esc_html__( 'Slider Settings', 'cinerama-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'            => '',
			'type'                    => 'grid',
			'images'                  => '',
			'image_size'              => 'thumbnail',
			'enable_image_shadow'     => 'no',
			'image_behavior'          => '',
			'custom_links'            => '',
			'custom_link_target'      => '_self',
			'number_of_columns'       => 'three',
			'space_between_items'     => 'normal',
			'number_of_visible_items' => '1',
			'slider_loop'             => 'yes',
			'slider_autoplay'         => 'yes',
			'slider_speed'            => '5000',
			'slider_speed_animation'  => '600',
			'slider_padding'          => 'no',
			'slider_navigation'       => 'yes',
			'slider_pagination'       => 'yes'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['inner_classes']  = $this->getInnerClasses( $params, $args );
		$params['slider_data']    = $this->getSliderData( $params );
		
		$params['type']               = ! empty( $params['type'] ) ? $params['type'] : $args['type'];
		$params['images']             = $this->getGalleryImages( $params );
		$params['image_size']         = $this->getImageSize( $params['image_size'] );
		$params['image_behavior']     = ! empty( $params['image_behavior'] ) ? $params['image_behavior'] : $args['image_behavior'];
		$params['custom_links']       = $this->getCustomLinks( $params );
		$params['custom_link_target'] = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : $args['custom_link_target'];
		
		$html = cinerama_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'image-gallery', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'edgtf-ig-' . $params['type'] . '-type' : 'edgtf-ig-' . $args['type'] . '-type';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'edgtf-' . $params['space_between_items'] . '-space' : 'edgtf-' . $args['space_between_items'] . '-space';
		$holderClasses[] = $params['enable_image_shadow'] === 'yes' ? 'edgtf-has-shadow' : '';
		$holderClasses[] = ! empty( $params['image_behavior'] ) ? 'edgtf-image-behavior-' . $params['image_behavior'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getInnerClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = $params['type'] === 'masonry' ? 'edgtf-ig-masonry' : 'edgtf-ig-grid';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'edgtf-ig-' . $params['number_of_columns'] . '-columns' : 'edgtf-ig-' . $args['number_of_columns'] . '-columns';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getSliderData( $params ) {
		$slider_data = array();
		
		$slider_data['data-number-of-items']        = $params['number_of_visible_items'] !== '' && $params['type'] === 'carousel' ? $params['number_of_visible_items'] : '1';
		$slider_data['data-enable-loop']            = ! empty( $params['slider_loop'] ) ? $params['slider_loop'] : '';
		$slider_data['data-enable-autoplay']        = ! empty( $params['slider_autoplay'] ) ? $params['slider_autoplay'] : '';
		$slider_data['data-slider-speed']           = ! empty( $params['slider_speed'] ) ? $params['slider_speed'] : '5000';
		$slider_data['data-slider-speed-animation'] = ! empty( $params['slider_speed_animation'] ) ? $params['slider_speed_animation'] : '600';
		$slider_data['data-slider-padding']         = ! empty( $params['slider_padding'] ) ? $params['slider_padding'] : '';
		$slider_data['data-enable-navigation']      = ! empty( $params['slider_navigation'] ) ? $params['slider_navigation'] : '';
		$slider_data['data-enable-pagination']      = ! empty( $params['slider_pagination'] ) ? $params['slider_pagination'] : '';
		
		return $slider_data;
	}
	
	private function getGalleryImages( $params ) {
		$image_ids = array();
		$images    = array();
		$i         = 0;
		
		if ( $params['images'] !== '' ) {
			$image_ids = explode( ',', $params['images'] );
		}
		
		foreach ( $image_ids as $id ) {
			
			$image['image_id'] = $id;
			$image_original    = wp_get_attachment_image_src( $id, 'full' );
			$image['url']      = $image_original[0];
			$image['title']    = get_the_title( $id );
			$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
			$image['caption']  = '';

			if ($image_object = get_post($id)) {
				$image['caption'] = $image_object->post_excerpt;
			}
			
			$images[ $i ] = $image;
			$i ++;
		}
		
		return $images;
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
	
	private function getCustomLinks( $params ) {
		$custom_links = array();
		
		if ( ! empty( $params['custom_links'] ) ) {
			$custom_links = array_map( 'trim', explode( ',', $params['custom_links'] ) );
		}
		
		return $custom_links;
	}
}