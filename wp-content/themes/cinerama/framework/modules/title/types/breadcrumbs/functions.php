<?php

if ( ! function_exists( 'cinerama_edge_set_title_breadcrumbs_type_for_options' ) ) {
	/**
	 * This function set breadcrumbs title type value for title options map and meta boxes
	 */
	function cinerama_edge_set_title_breadcrumbs_type_for_options( $type ) {
		$type['breadcrumbs'] = esc_html__( 'Breadcrumbs', 'cinerama' );
		
		return $type;
	}
	
	add_filter( 'cinerama_edge_filter_title_type_global_option', 'cinerama_edge_set_title_breadcrumbs_type_for_options' );
	add_filter( 'cinerama_edge_filter_title_type_meta_boxes', 'cinerama_edge_set_title_breadcrumbs_type_for_options' );
}

if ( ! function_exists( 'cinerama_edge_custom_breadcrumbs' ) ) {
	/**
	 * Function that renders breadcrumbs
	 */
	function cinerama_edge_custom_breadcrumbs() {
		global $post;
		
		$pageid    = cinerama_edge_get_page_id();
		$homeLink  = esc_url( home_url( '/' ) );
		$home      = esc_html__( 'Home', 'cinerama' );
		$delimiter = '<span class="edgtf-delimiter">&nbsp; / &nbsp;</span>';
		$before    = '<span class="edgtf-current">';
		$after     = '</span>';
		
		$holder_classes = array();
		$holder_styles  = array();
		
		$colorMeta = get_post_meta( $pageid, 'edgtf_breadcrumbs_color_meta', true );
		if ( ! empty( $colorMeta ) ) {
			$holder_classes[] = 'edgtf-has-inline-style';
			$holder_styles[]  = 'color: ' . $colorMeta;
		}
		
		$holder_classes = implode( ' ', $holder_classes );
		
		$output = '<div itemprop="breadcrumb" class="edgtf-breadcrumbs ' . esc_attr( $holder_classes ) . '" ' . cinerama_edge_get_inline_attr( $holder_styles, 'style', ';' ) . '>';
		
			if ( is_home() && ! is_front_page() ) {
				$output .= '<a itemprop="url" href="' . $homeLink . '">' . $home . '</a>' . $delimiter . ' <a itemprop="url" href="' . $homeLink . '">' . get_the_title( $pageid ) . '</a>';
				
			} elseif ( is_home() ) {
				$output .= $before . $home . $after;
				
			} elseif ( is_front_page() ) {
				$output .= '<a itemprop="url" href="' . $homeLink . '">' . $home . '</a>';
				
			} else {
				$output       .= '<a itemprop="url" href="' . $homeLink . '">' . $home . '</a>' . $delimiter;
				$childContent = '';
				
				if ( is_tag() ) {
					$childContent .= $before . esc_html__( 'Posts tagged ', 'cinerama' ) . '"' . single_tag_title( '', false ) . '"' . $after;
					
				} elseif ( is_day() ) {
					$childContent .= '<a itemprop="url" href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $delimiter;
					$childContent .= '<a itemprop="url" href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a>' . $delimiter;
					$childContent .= $before . get_the_time( 'd' ) . $after;
					
				} elseif ( is_month() ) {
					$childContent .= '<a itemprop="url" href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a>' . $delimiter;
					$childContent .= $before . get_the_time( 'F' ) . $after;
					
				} elseif ( is_year() ) {
					$childContent .= $before . get_the_time( 'Y' ) . $after;
					
				} elseif ( is_author() ) {
					$author_id = get_query_var( 'author' );
					$childContent    .= $before . esc_html__( 'Articles posted by ', 'cinerama' ) . get_the_author_meta( 'display_name', $author_id ) . $after;
					
				} elseif ( is_category() ) {
					$thisCat = get_category( get_query_var( 'cat' ), false );
					if ( isset( $thisCat->parent ) && $thisCat->parent != 0 ) {
						$childContent .= get_category_parents( $thisCat->parent, true, ' ' . $delimiter );
					}
					
					$childContent .= $before . single_cat_title( '', false ) . $after;
					
				} elseif ( is_search() ) {
					$childContent .= $before . esc_html__( 'Search results for ', 'cinerama' ) . '"' . get_search_query() . '"' . $after;
					
				} elseif ( is_404() ) {
					$childContent .= $before . esc_html__( 'Error 404', 'cinerama' ) . $after;
					
				} elseif ( is_single() && ! is_attachment() ) {
					if ( is_singular( 'post' ) ) {
						$cat  = get_the_category();
						$cat  = $cat[0];
						$cats = get_category_parents( $cat, true, ' ' . $delimiter );
						
						$childContent .= $cats;
						$childContent .= $before . get_the_title() . $after;
					} else {
						$childContent .= $before . get_the_title() . $after;
					}
					
				} elseif ( is_attachment() ) {
					if ( $post->post_parent ) {
						$parent = get_post( $post->post_parent );
						$cat    = get_the_category( $parent->ID );
						if ( $cat ) {
							$cat    = $cat[0];
							$childContent .= get_category_parents( $cat, true, ' ' . $delimiter );
						}
						$childContent .= '<a itemprop="url" href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>';
						
						$childContent .= $delimiter . $before . get_the_title() . $after;
						
					} else {
						$childContent .= $before . get_the_title() . $after;
					}
					
				} elseif ( is_page() ) {
					if ( $post->post_parent ) {
						$parent_ids   = array();
						$parent_ids[] = $post->post_parent;
						
						foreach ( $parent_ids as $parent_id ) {
							$childContent .= '<a itemprop="url" href="' . get_the_permalink( $parent_id ) . '">' . get_the_title( $parent_id ) . '</a>' . $delimiter;
						}
					}
					
					$childContent .= $before . get_the_title() . $after;
					
				}
				
				if ( get_query_var( 'paged' ) ) {
					$childContent .= $before . " (" . esc_html__( 'Page', 'cinerama' ) . ' ' . get_query_var( 'paged' ) . ")" . $after;
					
				}
				
				$output .= apply_filters( 'cinerama_edge_filter_breadcrumbs_title_child_output', $childContent, $delimiter, $before, $after );
			}
		
		$output .= '</div>';
		
		echo wp_kses( apply_filters( 'cinerama_edge_filter_breadcrumbs_title_output', $output ), array(
			'div'  => array(
				'itemprop' => true,
				'id'       => true,
				'class'    => true,
				'style'    => true
			),
			'span' => array(
				'class' => true,
				'id'    => true,
				'style' => true
			),
			'a'    => array(
				'itemprop' => true,
				'id'       => true,
				'class'    => true,
				'href'     => true,
				'style'    => true
			)
		) );
	}
}