<?php
namespace CineramaCore\CPT\Shortcodes\SectionTitle;

use CineramaCore\Lib;

class SectionTitle implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'edgtf_section_title';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Section Title', 'cinerama-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by CINERAMA', 'cinerama-core' ),
					'icon'                      => 'icon-wpb-section-title extended-custom-icon',
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
							'heading'     => esc_html__( 'Type', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'Standard', 'cinerama-core' )    => 'standard',
								esc_html__( 'Reverse', 'cinerama-core' )    => 'reverse',
								esc_html__( 'Two Columns', 'cinerama-core' ) => 'two-columns'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_position',
							'heading'     => esc_html__( 'Title - Text Position', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'Title Left - Text Right', 'cinerama-core' ) => 'title-left',
								esc_html__( 'Title Right - Text Left', 'cinerama-core' ) => 'title-right'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'two-columns' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_text_ratio',
							'heading'     => esc_html__( 'Title - Text Width Ratio', 'cinerama-core' ),
							'value'       => array(
								esc_html__( '1:1', 'cinerama-core' ) => '1-1',
								esc_html__( '1:2', 'cinerama-core' ) => '1-2',
								esc_html__( '1:3', 'cinerama-core' ) => '1-3',
								esc_html__( '1:4', 'cinerama-core' ) => '1-4',
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'two-columns' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'columns_space',
							'heading'     => esc_html__( 'Space Between Columns', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'Large', 'cinerama-core' )  => 'large',
								esc_html__( 'Medium', 'cinerama-core' ) => 'medium',
								esc_html__( 'Normal', 'cinerama-core' ) => 'normal',
								esc_html__( 'Small', 'cinerama-core' )  => 'small',
								esc_html__( 'Tiny', 'cinerama-core' )   => 'tiny'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'two-columns' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'position',
							'heading'     => esc_html__( 'Horizontal Position', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'Default', 'cinerama-core' ) => '',
								esc_html__( 'Left', 'cinerama-core' )    => 'left',
								esc_html__( 'Center', 'cinerama-core' )  => 'center',
								esc_html__( 'Right', 'cinerama-core' )   => 'right'
							),
							'save_always' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'standard', 'reverse' ) )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'holder_padding',
							'heading'    => esc_html__( 'Holder Side Padding (px or %)', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'cinerama-core' ),
							'admin_label' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'subtitle',
							'heading'     => esc_html__( 'Subitle', 'cinerama-core' ),
							'admin_label' => true,
							'dependency'  => array( 'element' => 'type', 'value' => array( 'two-columns' ) )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'title_tag',
							'heading'     => esc_html__( 'Title Tag', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_title_tag( true ) ),
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
							'type'        => 'dropdown',
							'param_name'  => 'subtitle_tag',
							'heading'     => esc_html__( 'Subtitle Tag', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_title_tag( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'       => esc_html__( 'Subtitle Style', 'cinerama-core' )
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'subtitle_color',
							'heading'    => esc_html__( 'Subtitle Color', 'cinerama-core' ),
							'dependency' => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'      => esc_html__( 'Subtitle Style', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'subtitle_margin',
							'heading'     => esc_html__( 'Subtitle Margin', 'cinerama-core' ),
							'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'cinerama-core' ),
							'dependency'  => array( 'element' => 'subtitle', 'not_empty' => true ),
							'group'       => esc_html__( 'Subtitle Style', 'cinerama-core' )
						),
						array(
							'type'       => 'textarea',
							'param_name' => 'text',
							'heading'    => esc_html__( 'Text', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_tag',
							'heading'     => esc_html__( 'Text Tag', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_title_tag( true, array( 'p' => 'p' ) ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'cinerama-core' )
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
							'param_name' => 'text_font_size',
							'heading'    => esc_html__( 'Text Font Size (px)', 'cinerama-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'cinerama-core' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'text_line_height',
							'heading'    => esc_html__( 'Text Line Height (px)', 'cinerama-core' ),
							'dependency' => array( 'element' => 'text', 'not_empty' => true ),
							'group'      => esc_html__( 'Text Style', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'text_font_weight',
							'heading'     => esc_html__( 'Text Font Weight', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_font_weight_array( true ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'text_margin',
							'heading'     => esc_html__( 'Text Margin', 'cinerama-core' ),
							'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'cinerama-core' ),
							'dependency'  => array( 'element' => 'text', 'not_empty' => true ),
							'group'       => esc_html__( 'Text Style', 'cinerama-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'        => '',
			'type'                => 'standard',
			'title_position'      => 'title-left',
			'title_text_ratio'    => '1-2',
			'columns_space'       => 'large',
			'position'            => '',
			'holder_padding'      => '',
			'title'               => '',
			'title_tag'           => 'h3',
			'title_color'         => '',
			'text'                => '',
			'subtitle'            => '',
			'subtitle_tag'        => 'h6',
			'subtitle_color'      => '',
			'subtitle_margin'     => '',
			'text'                => '',
			'text_tag'            => 'h6',
			'text_color'          => '',
			'text_font_size'      => '',
			'text_line_height'    => '',
			'text_font_weight'    => '',
			'text_margin'         => ''
		);
		$params = shortcode_atts( $args, $atts );

		$params['holder_classes']  = $this->getHolderClasses( $params, $args );
		$params['holder_styles']   = $this->getHolderStyles( $params );
		$params['title_tag']       = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $args['title_tag'];
		$params['subtitle_tag']    = ! empty( $params['subtitle_tag'] ) ? $params['subtitle_tag'] : $args['subtitle_tag'];
		$params['title_styles']    = $this->getTitleStyles( $params );
		$params['subtitle_styles'] = $this->getSubtitleStyles( $params );
		$params['text_tag']        = ! empty( $params['text_tag'] ) ? $params['text_tag'] : $args['text_tag'];
		$params['text_styles']     = $this->getTextStyles( $params );

		if ( ! in_array( $params['type'], array( 'standard', 'reverse', 'two-columns' ) ) ) {
			$params['type'] = $args['type'];
		}

		$html = cinerama_core_get_shortcode_module_template_part( 'templates/section-title', 'section-title', $params['type'], $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'edgtf-st-' . $params['type'] : 'edgtf-st-' . $args['type'];
		$holderClasses[] = ! empty( $params['title_position'] ) ? 'edgtf-st-' . $params['title_position'] : 'edgtf-st-' . $args['title_position'];
		$holderClasses[] = ! empty( $params['title_text_ratio'] ) ? 'edgtf-st-ratio-' . $params['title_text_ratio'] : 'edgtf-st-ratio-' . $args['title_text_ratio'];
		$holderClasses[] = ! empty( $params['columns_space'] ) ? 'edgtf-st-' . $params['columns_space'] . '-space' : 'edgtf-st-' . $args['columns_space'] . '-space';

		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['holder_padding'] ) ) {
			$styles[] = 'padding: 0 ' . $params['holder_padding'];
		}
		
		if ( ! empty( $params['position'] ) ) {
			$styles[] = 'text-align: ' . $params['position'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		return implode( ';', $styles );
	}

	private function getSubtitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['subtitle_color'] ) ) {
			$styles[] = 'color: ' . $params['subtitle_color'];
		}

		if ( $params['subtitle_margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['subtitle_margin'];
		}

		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( ! empty( $params['text_font_size'] ) ) {
			$styles[] = 'font-size: ' . cinerama_edge_filter_px( $params['text_font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['text_line_height'] ) ) {
			$styles[] = 'line-height: ' . cinerama_edge_filter_px( $params['text_line_height'] ) . 'px';
		}
		
		if ( ! empty( $params['text_font_weight'] ) ) {
			$styles[] = 'font-weight: ' . $params['text_font_weight'];
		}
		
		if ( $params['text_margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['text_margin'];
		}
		
		return implode( ';', $styles );
	}
}