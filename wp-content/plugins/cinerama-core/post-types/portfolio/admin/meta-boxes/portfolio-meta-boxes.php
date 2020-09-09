<?php

if ( ! function_exists( 'cinerama_core_map_portfolio_meta' ) ) {
	function cinerama_core_map_portfolio_meta() {
		global $cinerama_edge_global_Framework;
		
		$cinerama_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$cinerama_pages[ $page->ID ] = $page->post_title;
		}

		//Portfolio Single Upload Images/Videos

		$cinerama_portfolio_images_videos = cinerama_edge_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'cinerama-core' ),
				'name'  => 'edgtf_portfolio_images_videos'
			)
		);
		cinerama_edge_add_repeater_field(
			array(
				'name'        => 'edgtf_portfolio_single_upload',
				'parent'      => $cinerama_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'cinerama-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'cinerama-core' ),
						'options' => array(
							'image' => esc_html__('Image','cinerama-core'),
							'video' => esc_html__('Video','cinerama-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'cinerama-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'cinerama-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'cinerama-core'),
							'vimeo' => esc_html__('Vimeo', 'cinerama-core'),
							'self' => esc_html__('Self Hosted', 'cinerama-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'cinerama-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'cinerama-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'cinerama-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);

		//Portfolio Images
		
		$cinerama_portfolio_images = new CineramaEdgeClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'cinerama-core' ), '', '', 'portfolio_images' );
		$cinerama_edge_global_Framework->edgtMetaBoxes->addMetaBox( 'portfolio_images', $cinerama_portfolio_images );
		
		$cinerama_portfolio_image_gallery = new CineramaEdgeClassMultipleImages( 'edgtf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'cinerama-core' ), esc_html__( 'Choose your portfolio images', 'cinerama-core' ) );
		$cinerama_portfolio_images->addChild( 'edgtf-portfolio-image-gallery', $cinerama_portfolio_image_gallery );
		
		//Portfolio Additional Sidebar Items
		
		$cinerama_additional_sidebar_items = cinerama_edge_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'cinerama-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		cinerama_edge_add_repeater_field(
			array(
				'name'        => 'edgtf_portfolio_properties',
				'parent'      => $cinerama_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'cinerama-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'cinerama-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'cinerama-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'cinerama-core' )
					)
				)
			)
		);
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_core_map_portfolio_meta', 40 );
}