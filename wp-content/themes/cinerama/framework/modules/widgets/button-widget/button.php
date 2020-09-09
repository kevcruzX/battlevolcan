<?php

class CineramaEdgeClassButtonWidget extends CineramaEdgeClassWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_button_widget',
			esc_html__( 'Cinerama Button Widget', 'cinerama' ),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'cinerama' ) )
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
					'solid'   => esc_html__( 'Solid', 'cinerama' ),
					'outline' => esc_html__( 'Outline', 'cinerama' ),
					'simple'  => esc_html__( 'Simple', 'cinerama' )
				)
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'size',
				'title'       => esc_html__( 'Size', 'cinerama' ),
				'options'     => array(
					'small'  => esc_html__( 'Small', 'cinerama' ),
					'medium' => esc_html__( 'Medium', 'cinerama' ),
					'large'  => esc_html__( 'Large', 'cinerama' ),
					'huge'   => esc_html__( 'Huge', 'cinerama' )
				),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'cinerama' )
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__( 'Text', 'cinerama' ),
				'default' => esc_html__( 'Button Text', 'cinerama' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'cinerama' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Link Target', 'cinerama' ),
				'options' => cinerama_edge_get_link_target_array()
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'cinerama' )
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'hover_color',
				'title' => esc_html__( 'Hover Color', 'cinerama' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'background_color',
				'title'       => esc_html__( 'Background Color', 'cinerama' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'cinerama' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_background_color',
				'title'       => esc_html__( 'Hover Background Color', 'cinerama' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'cinerama' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'border_color',
				'title'       => esc_html__( 'Border Color', 'cinerama' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'cinerama' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_border_color',
				'title'       => esc_html__( 'Hover Border Color', 'cinerama' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'cinerama' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__( 'Margin', 'cinerama' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'cinerama' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$params = '';
		
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		// Default values
		if ( ! isset( $instance['text'] ) ) {
			$instance['text'] = 'Button Text';
		}
		
		// Generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget edgtf-button-widget">';
			echo do_shortcode( "[edgtf_button $params]" ); // XSS OK
		echo '</div>';
	}
}