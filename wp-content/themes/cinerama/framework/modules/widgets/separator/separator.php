<?php

class CineramaEdgeClassSeparatorWidget extends CineramaEdgeClassWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_separator_widget',
			esc_html__( 'Cinerama Separator Widget', 'cinerama' ),
			array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'cinerama' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'cinerama' ),
				'options' => array(
					'normal'     => esc_html__( 'Normal', 'cinerama' ),
					'full-width' => esc_html__( 'Full Width', 'cinerama' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'position',
				'title'   => esc_html__( 'Position', 'cinerama' ),
				'options' => array(
					'center' => esc_html__( 'Center', 'cinerama' ),
					'left'   => esc_html__( 'Left', 'cinerama' ),
					'right'  => esc_html__( 'Right', 'cinerama' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'border_style',
				'title'   => esc_html__( 'Style', 'cinerama' ),
				'options' => array(
					'solid'  => esc_html__( 'Solid', 'cinerama' ),
					'dashed' => esc_html__( 'Dashed', 'cinerama' ),
					'dotted' => esc_html__( 'Dotted', 'cinerama' )
				)
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'cinerama' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'width',
				'title' => esc_html__( 'Width (px or %)', 'cinerama' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'thickness',
				'title' => esc_html__( 'Thickness (px)', 'cinerama' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'top_margin',
				'title' => esc_html__( 'Top Margin (px or %)', 'cinerama' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'bottom_margin',
				'title' => esc_html__( 'Bottom Margin (px or %)', 'cinerama' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		echo '<div class="widget edgtf-separator-widget">';
			echo do_shortcode( "[edgtf_separator $params]" ); // XSS OK
		echo '</div>';
	}
}