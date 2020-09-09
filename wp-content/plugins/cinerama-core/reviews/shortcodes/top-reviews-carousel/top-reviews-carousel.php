<?php

namespace CineramaCore\CPT\Shortcodes\TopReviewsCarousel;

use CineramaCore\Lib\ShortcodeInterface;

class TopReviewsCarousel implements ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'cinerama_core_top_reviews_carousel';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		$criteria_ratings = cinerama_core_rating_criteria_for_vc();
		
		vc_map(
			array(
				'name'                      => esc_html__( 'Top Reviews Carousel', 'cinerama-core' ),
				'base'                      => $this->base,
				'category'                  => esc_html__( 'by CINERAMA', 'cinerama-core' ),
				'icon'                      => 'icon-wpb-top-reviews-carousel extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params'                    => array(
					array(
						'type'        => 'textfield',
						'param_name'  => 'title',
						'heading'     => esc_html__( 'Title', 'cinerama-core' ),
						'admin_label' => true
					),
					array(
						'type'        => 'textfield',
						'param_name'  => 'number_of_reviews',
						'heading'     => esc_html__( 'Number of Reviews', 'cinerama-core' ),
						'description' => esc_html__( 'Leave empty for all', 'cinerama-core' )
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'review_criteria',
						'heading'     => esc_html__( 'Order by Review Criteria', 'cinerama-core' ),
						'value'       => $criteria_ratings,
						'save_always' => true
					)
				)
			)
		);
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'title'             => '',
			'number_of_reviews' => '',
			'review_criteria'   => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['reviews']        = $this->getTopReviews( $params );
		$params['this_shortcode'] = $this;
		
		return cinerama_core_get_module_shortcode_template_part( 'reviews', 'top-reviews-carousel', 'top-reviews-carousel', '', $params );
	}
	
	public function getTopReviews( $params ) {
		$number = isset( $params['number_of_reviews'] ) ? $params['number_of_reviews'] : '';
		
		$args = array(
			'status' => 'approve',
			'number' => $number
		);
		
		if ( isset( $params['review_criteria'] ) && ! empty( $params['review_criteria'] ) ) {
			$meta_query = array();
			
			$meta_query[]       = array(
				'key'     => $params['review_criteria'],
				'compare' => 'EXISTS'
			);
			$args['meta_query'] = $meta_query;
			$args['orderby']    = 'meta_value';
		}
		
		$comments = get_comments( $args );
		
		return $comments;
	}
	
	public function generateItemParams( $params ) {
		$comment                     = $params['comment'];
		$new_comment                 = array();
		$new_comment['comment_id']   = $comment->comment_ID;
		$new_comment['post_link']    = get_the_permalink( $comment->comment_post_ID );
		$new_comment['post_title']   = get_the_title( $comment->comment_post_ID );
		$new_comment['comment_text'] = get_comment_text( $comment->comment_ID );
		$new_comment['auhtor_email'] = $comment->comment_author_email;
		
		if ( isset( $params['review_criteria'] ) && ! empty( $params['review_criteria'] ) ) {
			$new_comment['review_value'] = get_comment_meta( $comment->comment_ID, $params['review_criteria'], true );
		}
		
		return $new_comment;
	}
}