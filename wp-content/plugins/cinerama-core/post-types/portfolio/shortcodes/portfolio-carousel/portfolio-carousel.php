<?php

namespace CineramaCore\CPT\Shortcodes\Portfolio;

use CineramaCore\Lib;

class PortfolioCarousel implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_portfolio_carousel';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Portfolio category filter
		add_filter( 'vc_autocomplete_edgtf_portfolio_carousel_category_callback', array( &$this, 'portfolioCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio category render
		add_filter( 'vc_autocomplete_edgtf_portfolio_carousel_category_render', array( &$this, 'portfolioCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio selected projects filter
		add_filter( 'vc_autocomplete_edgtf_portfolio_carousel_selected_projects_callback', array( &$this, 'portfolioIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio selected projects render
		add_filter( 'vc_autocomplete_edgtf_portfolio_carousel_selected_projects_render', array( &$this, 'portfolioIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)
		
		//Portfolio tag filter
		add_filter( 'vc_autocomplete_edgtf_portfolio_carousel_tag_callback', array( &$this, 'portfolioTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Portfolio tag render
		add_filter( 'vc_autocomplete_edgtf_portfolio_carousel_tag_render', array( &$this, 'portfolioTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Portfolio Carousel', 'cinerama-core' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by CINERAMA', 'cinerama-core' ),
					'icon'     => 'icon-wpb-portfolio-carousel extended-custom-icon',
					'params'   => array(
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
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Portfolios Items', 'cinerama-core' ),
							'admin_label' => true,
							'description' => esc_html__( 'Set number of items for your portfolio carousel. Enter -1 to show all', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_space_between_items_array( false, true, true, true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'image_proportions',
							'heading'     => esc_html__( 'Image Proportions', 'cinerama-core' ),
							'value'       => array(
								esc_html__( 'Original', 'cinerama-core' )  => 'full',
								esc_html__( 'Square', 'cinerama-core' )    => 'square',
								esc_html__( 'Landscape', 'cinerama-core' ) => 'landscape',
								esc_html__( 'Portrait', 'cinerama-core' )  => 'portrait',
								esc_html__( 'Medium', 'cinerama-core' )    => 'medium',
								esc_html__( 'Large', 'cinerama-core' )     => 'large'
							),
							'description' => esc_html__( 'Set image proportions for your portfolio carousel.', 'cinerama-core' ),
							'save_always' => true
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category',
							'heading'     => esc_html__( 'One-Category Portfolio Carousel', 'cinerama-core' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'cinerama-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'selected_projects',
							'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'cinerama-core' ),
							'settings'    => array(
								'multiple'      => true,
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'cinerama-core' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'tag',
							'heading'     => esc_html__( 'One-Tag Portfolio Carousel', 'cinerama-core' ),
							'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_title',
							'heading'    => esc_html__( 'Enable Title', 'cinerama-core' ),
							'value'      => array_flip( cinerama_edge_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'cinerama-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_tag',
							'heading'    => esc_html__( 'Title Tag', 'cinerama-core' ),
							'value'      => array_flip( cinerama_edge_get_title_tag( true ) ),
							'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Content Layout', 'cinerama-core' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'title_text_transform',
							'heading'    => esc_html__( 'Title Text Transform', 'cinerama-core' ),
							'value'      => array_flip( cinerama_edge_get_text_transform_array( true ) ),
							'dependency' => array( 'element' => 'enable_title', 'value' => array( 'yes' ) ),
							'group'      => esc_html__( 'Content Layout', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_autoplay',
							'heading'     => esc_html__( 'Enable Carousel Autoplay', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false, true ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Carousel Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'carousel_speed',
							'heading'     => esc_html__( 'Slide Duration', 'cinerama-core' ),
							'description' => esc_html__( 'Default value is 5000 (ms)', 'cinerama-core' ),
							'group'       => esc_html__( 'Carousel Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'carousel_speed_animation',
							'heading'     => esc_html__( 'Slide Animation Duration', 'cinerama-core' ),
							'description' => esc_html__( 'Speed of slide animation in milliseconds. Default value is 600.', 'cinerama-core' ),
							'group'       => esc_html__( 'Carousel Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'carousel_stage_padding',
							'heading'     => esc_html__( 'Stage Padding (%)', 'cinerama-core' ),
							'description' => esc_html__( 'Input the percentage value for the visible preview part for the sliders located to the left and right of the currently highlighted slide.', 'cinerama-core' ),
							'group'       => esc_html__( 'Carousel Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_navigation',
							'heading'     => esc_html__( 'Enable Carousel Navigation Arrows', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false, false ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Carousel Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_custom_navigation',
							'heading'     => esc_html__( 'Enable Cursor Follow Navigation Arrows', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false, false ) ),
							'save_always' => true,
							'dependency'  => array( 'element' => 'enable_navigation', 'value' => array( 'yes' ) ),
							'group'       => esc_html__( 'Carousel Settings', 'cinerama-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'enable_pagination',
							'heading'     => esc_html__( 'Enable Carousel Pagination', 'cinerama-core' ),
							'value'       => array_flip( cinerama_edge_get_yes_no_select_array( false, false ) ),
							'save_always' => true,
							'group'       => esc_html__( 'Carousel Settings', 'cinerama-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'skin'                     => '',
			'number_of_items'          => '9',
			'space_between_items'      => 'medium',
			'image_proportions'        => 'full',
			'category'                 => '',
			'selected_projects'        => '',
			'tag'                      => '',
			'orderby'                  => 'date',
			'order'                    => 'ASC',
			'enable_title'             => 'yes',
			'title_tag'                => 'h1',
			'title_text_transform'     => '',
			'enable_autoplay'          => 'yes',
			'carousel_speed'           => '5000',
			'carousel_speed_animation' => '600',
			'carousel_stage_padding'   => '20',
			'carousel_padding'         => 'no',
			'enable_navigation'        => 'no',
			'enable_custom_navigation' => 'no',
			'enable_pagination'        => 'no'
		);
		$params = shortcode_atts( $args, $atts );

		$query_array                      = $this->getQueryArray( $params );
		$query_results                    = new \WP_Query( $query_array );
		$params['query_results']          = $query_results;

		$params['carousel_stage_padding'] = $this->parseStagePadding( $params, $args );

		$params['carousel_data']          = $this->getSliderData( $params, $args );
		$params['holder_classes']         = $this->getHolderClasses( $params, $args );

		$params['this_object']            = $this;

		$html = cinerama_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-carousel', 'portfolio-carousel', '', $params );

		return $html;
	}

	public function getQueryArray( $params ) {
		$query_array = array(
			'post_status'    => 'publish',
			'post_type'      => 'portfolio-item',
			'posts_per_page' => $params['number_of_items'],
			'orderby'        => $params['orderby'],
			'order'          => $params['order']
		);

		if ( ! empty( $params['category'] ) ) {
			$query_array['portfolio-category'] = $params['category'];
		}

		$project_ids = null;
		if ( ! empty( $params['selected_projects'] ) ) {
			$project_ids             = explode( ',', $params['selected_projects'] );
			$query_array['post__in'] = $project_ids;
		}

		if ( ! empty( $params['tag'] ) ) {
			$query_array['portfolio-tag'] = $params['tag'];
		}

		if ( ! empty( $params['next_page'] ) ) {
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}

		return $query_array;
	}

	private function getSliderData( $params, $args ) {
		$data = array();

		$data['data-number-of-items']             = '1';
		$data['data-enable-loop']                 = 'yes';
		$data['data-enable-autoplay']             = ! empty( $params['enable_autoplay'] ) ? $params['enable_autoplay'] : $args['enable_autoplay'];
		$data['data-enable-autoplay-hover-pause'] = 'no';
		$data['data-slider-speed']                = ! empty( $params['carousel_speed'] ) ? $params['carousel_speed'] : $args['carousel_speed'];
		$data['data-slider-speed-animation']      = ! empty( $params['carousel_speed_animation'] ) ? $params['carousel_speed_animation'] : $args['carousel_speed_animation'];
		$data['data-enable-center']               = 'yes';
		$data['data-slider-custom-padding']       = 'yes';
		$data['data-slider-custom-padding-value'] = $params['carousel_stage_padding'];
		$data['data-enable-navigation']           = ! empty( $params['enable_navigation'] ) ? $params['enable_navigation'] : $args['enable_navigation'];
		$data['data-enable-pagination']           = ! empty( $params['enable_pagination'] ) ? $params['enable_pagination'] : $args['enable_pagination'];

		return $data;
	}

	public function getHolderClasses( $params, $args ) {
		$classes = array();
		
		$classes[] = ! empty( $params['skin'] ) ? 'edgtf-' . $params['skin'] . '-skin' : '';
		$classes[] = ! empty( $params['space_between_items'] ) ? 'edgtf-' . $params['space_between_items'] . '-space' : 'edgtf-' . $args['space_between_items'] . '-space';
		$classes[] = $params['enable_navigation'] === 'yes' && $params['enable_custom_navigation'] === 'yes' ? 'edgtf-owl-custom-nav' : '';

		return implode( ' ', $classes );
	}

	public function getImageSize( $params ) {
		$thumb_size = 'full';

		if ( ! empty( $params['image_proportions'] ) ) {
			$image_size = $params['image_proportions'];

			switch ( $image_size ) {
				case 'landscape':
					$thumb_size = 'cinerama_edge_image_landscape';
					break;
				case 'portrait':
					$thumb_size = 'cinerama_edge_image_portrait';
					break;
				case 'square':
					$thumb_size = 'cinerama_edge_image_square';
					break;
				case 'medium':
					$thumb_size = 'medium';
					break;
				case 'large':
					$thumb_size = 'large';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
			}
		}

		return $thumb_size;
	}

	public function parseStagePadding( $params, $args ) {
		$stage_padding = floatval($params['carousel_stage_padding']);

		if ($stage_padding < 0 || $stage_padding > 100) {
			$stage_padding = $args['carousel_stage_padding'];
		}

		return $stage_padding / 100;
	}

	public function getTitleStyles( $params ) {
		$styles = array();

		if ( ! empty( $params['title_text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['title_text_transform'];
		}

		return implode( ';', $styles );
	}

	public function getItemLink() {
		$portfolio_link_meta = get_post_meta( get_the_ID(), 'portfolio_external_link', true );
		$portfolio_link      = ! empty( $portfolio_link_meta ) ? $portfolio_link_meta : get_permalink( get_the_ID() );

		return apply_filters( 'cinerama_edge_filter_portfolio_external_link', $portfolio_link );
	}

	public function getItemLinkTarget() {
		$portfolio_link_meta   = get_post_meta( get_the_ID(), 'portfolio_external_link', true );
		$portfolio_link_target = ! empty( $portfolio_link_meta ) ? '_blank' : '_self';

		return apply_filters( 'cinerama_edge_filter_portfolio_external_link_target', $portfolio_link_target );
	}

	public function isVideoLink() {
		$single_upload = get_post_meta( get_the_ID(), 'edgtf_portfolio_single_upload', true );
		if ( is_array( $single_upload ) && count( $single_upload ) ) {
			foreach ( $single_upload as $item ) {
				if ( $item['file_type'] == 'video' ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Filter portfolio categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_category_title'] ) > 0 ) ? esc_html__( 'Category', 'cinerama-core' ) . ': ' . $value['portfolio_category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_category = get_term_by( 'slug', $query, 'portfolio-category' );
			if ( is_object( $portfolio_category ) ) {
				
				$portfolio_category_slug  = $portfolio_category->slug;
				$portfolio_category_title = $portfolio_category->name;
				
				$portfolio_category_title_display = '';
				if ( ! empty( $portfolio_category_title ) ) {
					$portfolio_category_title_display = esc_html__( 'Category', 'cinerama-core' ) . ': ' . $portfolio_category_title;
				}
				
				$data          = array();
				$data['value'] = $portfolio_category_slug;
				$data['label'] = $portfolio_category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter portfolios by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$portfolio_id    = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'portfolio-item' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $portfolio_id > 0 ? $portfolio_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'cinerama-core' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'cinerama-core' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio
			$portfolio = get_post( (int) $query );
			if ( ! is_wp_error( $portfolio ) ) {
				
				$portfolio_id    = $portfolio->ID;
				$portfolio_title = $portfolio->post_title;
				
				$portfolio_title_display = '';
				if ( ! empty( $portfolio_title ) ) {
					$portfolio_title_display = ' - ' . esc_html__( 'Title', 'cinerama-core' ) . ': ' . $portfolio_title;
				}
				
				$portfolio_id_display = esc_html__( 'Id', 'cinerama-core' ) . ': ' . $portfolio_id;
				
				$data          = array();
				$data['value'] = $portfolio_id;
				$data['label'] = $portfolio_id_display . $portfolio_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter portfolio tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function portfolioTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS portfolio_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'portfolio-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['portfolio_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'cinerama-core' ) . ': ' . $value['portfolio_tag_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find portfolio tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function portfolioTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get portfolio category
			$portfolio_tag = get_term_by( 'slug', $query, 'portfolio-tag' );
			if ( is_object( $portfolio_tag ) ) {
				
				$portfolio_tag_slug  = $portfolio_tag->slug;
				$portfolio_tag_title = $portfolio_tag->name;
				
				$portfolio_tag_title_display = '';
				if ( ! empty( $portfolio_tag_title ) ) {
					$portfolio_tag_title_display = esc_html__( 'Tag', 'cinerama-core' ) . ': ' . $portfolio_tag_title;
				}
				
				$data          = array();
				$data['value'] = $portfolio_tag_slug;
				$data['label'] = $portfolio_tag_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}