<?php

class CineramaEdgeClassBlogListWidget extends CineramaEdgeClassWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_blog_list_widget',
			esc_html__( 'Cinerama Blog List Widget', 'cinerama' ),
			array( 'description' => esc_html__( 'Display a list of your blog posts', 'cinerama' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'cinerama' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'cinerama' ),
				'options' => array(
					'simple'  => esc_html__( 'Simple', 'cinerama' ),
					'minimal' => esc_html__( 'Minimal', 'cinerama' )
				)
			),
			array(
				'type'  => 'textfield',
				'name'  => 'number_of_posts',
				'title' => esc_html__( 'Number of Posts', 'cinerama' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'space_between_items',
				'title'   => esc_html__( 'Space Between Items', 'cinerama' ),
				'options' => cinerama_edge_get_space_between_items_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'orderby',
				'title'   => esc_html__( 'Order By', 'cinerama' ),
				'options' => cinerama_edge_get_query_order_by_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'order',
				'title'   => esc_html__( 'Order', 'cinerama' ),
				'options' => cinerama_edge_get_query_order_array()
			),
			array(
				'type'        => 'textfield',
				'name'        => 'category',
				'title'       => esc_html__( 'Category Slug', 'cinerama' ),
				'description' => esc_html__( 'Leave empty for all or use comma for list', 'cinerama' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'image_size',
				'title'   => esc_html__( 'Image Size', 'cinerama' ),
				'options' => array(
					'full'                          => esc_html__( 'Original', 'cinerama' ),
					'cinerama_edge_image_square'    => esc_html__( 'Square', 'cinerama' ),
					'cinerama_edge_image_landscape' => esc_html__( 'Landscape', 'cinerama' ),
					'cinerama_edge_image_portrait'  => esc_html__( 'Portrait', 'cinerama' ),
					'thumbnail'                     => esc_html__( 'Thumbnail', 'cinerama' ),
					'medium'                        => esc_html__( 'Medium', 'cinerama' ),
					'large'                         => esc_html__( 'Large', 'cinerama' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_tag',
				'title'   => esc_html__( 'Title Tag', 'cinerama' ),
				'options' => cinerama_edge_get_title_tag( true )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'title_transform',
				'title'   => esc_html__( 'Title Text Transform', 'cinerama' ),
				'options' => cinerama_edge_get_text_transform_array( true )
			),
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		$instance['post_info_section'] = 'yes';
		$instance['number_of_columns'] = '1';
		
		// Filter out all empty params
		$instance         = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		$instance['type'] = ! empty( $instance['type'] ) ? $instance['type'] : 'simple';
		
		$params = '';
		//generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget edgtf-blog-list-widget">';
			if ( ! empty( $instance['widget_title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			
			echo do_shortcode( "[edgtf_blog_list $params]" ); // XSS OK
		echo '</div>';
	}
}