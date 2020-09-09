<?php
namespace CineramaCore\CPT\Shortcodes\InteractiveImageWithText;

use CineramaCore\Lib;

class InteractiveImageWithText implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_interactive_image_with_text';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Interactive Image With Text', 'cinerama-core' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by CINERAMA', 'cinerama-core' ),
					'icon'                      => 'icon-wpb-interactive-image-with-text extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'cinerama-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'cinerama-core' )
						),
						array(
							'type'        => 'attach_image',
							'param_name'  => 'image',
							'heading'     => esc_html__( 'Image', 'cinerama-core' ),
							'description' => esc_html__( 'Select image from media library', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_animation',
							'heading'     => esc_html__( 'Enable Animation', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'image', 'not_empty' => true, ),
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'image_size',
							'heading'     => esc_html__( 'Image Size', 'cinerama-core' ),
							'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'cinerama-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'custom_link',
							'heading'    => esc_html__( 'Custom Link', 'cinerama-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'custom_link_target',
							'heading'    => esc_html__( 'Custom Link Target', 'cinerama-core' ),
							'value'      => array_flip( cinerama_edge_get_link_target_array() )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'prefix_text',
							'heading'    => esc_html__( 'Prefix Text', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'prefix_text_position',
							'heading'     => esc_html__( 'Prefix Text Position', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'Left', 'cinerama-core' )  => 'left',
								esc_html__( 'Right', 'cinerama-core' ) => 'right'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'prefix_text', 'not_empty' => true )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'prefix_text_size',
							'heading'     => esc_html__( 'Prefix Text Size', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'Default', 'cinerama-core' ) => '',
								esc_html__( 'Small', 'cinerama-core' )   => 'small'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'prefix_text', 'not_empty' => true )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'prefix_text_color',
							'heading'    => esc_html__( 'Prefix Text Color', 'cinerama-core' ),
							'dependency' => array( 'element' => 'prefix_text', 'not_empty' => true )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Title', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_title_tag( true, array( 'span' => esc_html__( 'Custom Heading', 'cinerama-core' ) ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
							'group'       => esc_html__( 'Title Style', 'cinerama-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'title_color',
							'heading'    => esc_html__( 'Title Color', 'cinerama-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title Style', 'cinerama-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title_top_margin',
							'heading'    => esc_html__( 'Title Top Margin (px)', 'cinerama-core' ),
							'dependency' => array( 'element' => 'title', 'not_empty' => true ),
							'group'      => esc_html__( 'Title Style', 'cinerama-core' )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'cinerama-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'text_color',
							'heading'    => esc_html__( 'Text Color', 'cinerama-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'cinerama-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_top_margin',
							'heading'    => esc_html__( 'Text Top Margin (px)', 'cinerama-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'button_text',
							'heading'     => esc_html__( 'Button Text', 'cinerama-core' ),
							'value'       => esc_html__( 'Button Text', 'cinerama-core' ),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_top_margin',
							'heading'    => esc_html__( 'Button Top Margin (px)', 'cinerama-core' ),
							'dependency' => array( 'element' => 'layout', 'value' => array( 'simple' ) ),
							'group'      => esc_html__( 'Button Style', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'button_type',
							'heading'     => esc_html__( 'Button Type', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'Solid', 'cinerama-core' )   => 'solid',
								esc_html__( 'Outline', 'cinerama-core' ) => 'outline'
							),
							'save_always' => true,
							'group'       => esc_html__( 'Button Style', 'cinerama-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_skin',
							'heading'    => esc_html__( 'Button Skin', 'cinerama-core' ),
							'value'      => array(
								esc_html__( 'Default', 'cinerama-core' ) => '',
								esc_html__( 'Light', 'cinerama-core' )   => 'light',
							),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'outline' ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Button Style', 'cinerama-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_hover_animation',
							'heading'    => esc_html__( 'Button Hover Animation', 'cinerama-core' ),
							'value'      => array_flip( cinerama_edge_get_yes_no_select_array( false ) ),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'outline' ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Button Style', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'button_size',
							'heading'     => esc_html__( 'Button Size', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'Default', 'cinerama-core' ) => '',
								esc_html__( 'Small', 'cinerama-core' )   => 'small',
								esc_html__( 'Medium', 'cinerama-core' )  => 'medium',
								esc_html__( 'Large', 'cinerama-core' )   => 'large'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'button_type', 'value'   => array( 'solid', 'outline' ) ),
							'group'       => esc_html__( 'Button Style', 'cinerama-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'button_link',
							'heading'    => esc_html__( 'Button Link', 'cinerama-core' ),
							'group'      => esc_html__( 'Button Style', 'cinerama-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'button_target',
							'heading'    => esc_html__( 'Button Link Target', 'cinerama-core' ),
							'value'      => array_flip( cinerama_edge_get_link_target_array() ),
							'group'      => esc_html__( 'Button Style', 'cinerama-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_color',
							'heading'    => esc_html__( 'Button Color', 'cinerama-core' ),
							'group'      => esc_html__( 'Button Style', 'cinerama-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_color',
							'heading'    => esc_html__( 'Button Hover Color', 'cinerama-core' ),
							'group'      => esc_html__( 'Button Style', 'cinerama-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_background_color',
							'heading'    => esc_html__( 'Button Background Color', 'cinerama-core' ),
							'dependency' => array( 'element' => 'button_type', 'value' => array( 'solid' ) ),
							'group'      => esc_html__( 'Button Style', 'cinerama-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_background_color',
							'heading'    => esc_html__( 'Button Hover Background Color', 'cinerama-core' ),
							'group'      => esc_html__( 'Button Style', 'cinerama-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_border_color',
							'heading'    => esc_html__( 'Button Border Color', 'cinerama-core' ),
							'group'      => esc_html__( 'Button Style', 'cinerama-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'button_hover_border_color',
							'heading'    => esc_html__( 'Button Hover Border Color', 'cinerama-core' ),
							'group'      => esc_html__( 'Button Style', 'cinerama-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'                  => '',
			'image'                         => '',
			'enable_animation'              => 'no',
			'image_size'                    => 'full',
			'custom_link'                   => '',
			'custom_link_target'            => '_self',
			'prefix_text'                   => '',
			'prefix_text_position'          => 'left',
			'prefix_text_size'              => '',
			'prefix_text_color'             => '',
			'title'                         => '',
			'title_tag'                     => 'span',
			'title_color'                   => '',
			'title_top_margin'              => '',
			'text'                          => '',
			'text_color'                    => '',
			'text_top_margin'               => '',
			'button_text'                   => '',
			'button_top_margin'             => '',
			'button_type'                   => 'outline',
			'button_skin'                   => '',
			'button_hover_animation'        => 'no',
			'button_size'                   => 'medium',
			'button_link'                   => '',
			'button_target'                 => '_self',
			'button_color'                  => '',
			'button_hover_color'            => '',
			'button_background_color'       => '',
			'button_hover_background_color' => '',
			'button_border_color'           => '',
			'button_hover_border_color'     => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes']       = $this->getHolderClasses( $params );
		$params['custom_link_target']   = ! empty( $params['custom_link_target'] ) ? $params['custom_link_target'] : $args['custom_link_target'];
		$params['prefix_text_styles']   = $this->getPrefixTextStyles( $params );
		$params['title_styles']         = $this->getTitleStyles( $params );
		$params['title_tag']            = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['text_styles']          = $this->getTextStyles( $params );
		$params['button_holder_styles'] = $this->getButtonHolderStyles( $params );
		$params['button_parameters']    = $this->getButtonParameters( $params );
		
		$html = cinerama_core_get_shortcode_module_template_part( 'templates/interactive-image-with-text', 'interactive-image-with-text', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		
		if ( ! empty( $params['prefix_text'] ) ) {
			$holderClasses[] = 'edgtf-iiwt-has-prefix';
			
			if ( ! empty( $params['prefix_text_position'] ) ) {
				$holderClasses[] = 'edgtf-iiwt-prefix-' . $params['prefix_text_position'];
			}
			
			if ( ! empty( $params['prefix_text_size'] ) ) {
				$holderClasses[] = 'edgtf-iiwt-' . $params['prefix_text_size'] . '-space';
			}
		}
		
		$holderClasses[] = $params['enable_animation'] === 'yes' ? 'edgtf-iiwt-animation' : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getPrefixTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['prefix_text_color'] ) ) {
			$styles[] = 'color: ' . $params['prefix_text_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( $params['title_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . cinerama_edge_filter_px( $params['title_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . cinerama_edge_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getButtonHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['button_top_margin'] ) && $params['layout'] === 'simple' ) {
			$styles[] = 'margin-top: ' . cinerama_edge_filter_px( $params['button_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getButtonParameters( $params ) {
		$button_params_array = array();
		
		if ( ! empty( $params['button_text'] ) ) {
			$button_params_array['text'] = $params['button_text'];
		}
		
		if ( ! empty( $params['button_type'] ) ) {
			$button_params_array['type'] = $params['button_type'];
		}
		
		if ( ! empty( $params['button_skin'] ) ) {
			$button_params_array['skin'] = $params['button_skin'];
		}
		
		if ( ! empty( $params['button_hover_animation'] ) ) {
			$button_params_array['hover_animation'] = $params['button_hover_animation'];
		}
		
		if ( ! empty( $params['button_size'] ) ) {
			$button_params_array['size'] = $params['button_size'];
		}
		
		if ( ! empty( $params['button_link'] ) ) {
			$button_params_array['link'] = $params['button_link'];
		}
		
		$button_params_array['target'] = ! empty( $params['button_target'] ) ? $params['button_target'] : '_self';
		
		if ( ! empty( $params['button_color'] ) ) {
			$button_params_array['color'] = $params['button_color'];
		}
		
		if ( ! empty( $params['button_hover_color'] ) ) {
			$button_params_array['hover_color'] = $params['button_hover_color'];
		}
		
		if ( ! empty( $params['button_background_color'] ) ) {
			$button_params_array['background_color'] = $params['button_background_color'];
		}
		
		if ( ! empty( $params['button_hover_background_color'] ) ) {
			$button_params_array['hover_background_color'] = $params['button_hover_background_color'];
		}
		
		if ( ! empty( $params['button_border_color'] ) ) {
			$button_params_array['border_color'] = $params['button_border_color'];
		}
		
		if ( ! empty( $params['button_hover_border_color'] ) ) {
			$button_params_array['hover_border_color'] = $params['button_hover_border_color'];
		}
		
		return $button_params_array;
	}
}