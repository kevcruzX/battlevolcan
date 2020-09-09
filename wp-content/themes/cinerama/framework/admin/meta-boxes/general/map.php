<?php

if ( ! function_exists( 'cinerama_edge_map_general_meta' ) ) {
	function cinerama_edge_map_general_meta() {
		
		$general_meta_box = cinerama_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'cinerama_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'cinerama' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'cinerama' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'cinerama' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'cinerama' ),
				'parent'        => $general_meta_box
			)
		);
		
		$edgtf_content_padding_group = cinerama_edge_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Style', 'cinerama' ),
				'description' => esc_html__( 'Define styles for Content area', 'cinerama' ),
				'parent'      => $general_meta_box
			)
		);
		
			$edgtf_content_padding_row = cinerama_edge_add_admin_row(
				array(
					'name'   => 'edgtf_content_padding_row',
					'next'   => true,
					'parent' => $edgtf_content_padding_group
				)
			);
		
				cinerama_edge_create_meta_box_field(
					array(
						'name'   => 'edgtf_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (e.g. 10px 5px 10px 5px)', 'cinerama' ),
						'parent' => $edgtf_content_padding_row,
					)
				);
				
				cinerama_edge_create_meta_box_field(
					array(
						'name'    => 'edgtf_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (e.g. 10px 5px 10px 5px)', 'cinerama' ),
						'parent'  => $edgtf_content_padding_row,
					)
				);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_page_background_color_meta',
				'type'        => 'color',
				'label'       => esc_html__( 'Page Background Color', 'cinerama' ),
				'description' => esc_html__( 'Choose background color for page content', 'cinerama' ),
				'parent'      => $general_meta_box
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_page_background_image_meta',
				'type'          => 'image',
				'label'         => esc_html__( 'Page Background Image', 'cinerama' ),
				'description'   => esc_html__( 'Choose background image for page content', 'cinerama' ),
				'parent'        => $general_meta_box
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_page_background_repeat_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Page Background Image Repeat', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will set page background image as pattern in otherwise will be cover background image', 'cinerama' ),
				'options'       => cinerama_edge_get_yes_no_select_array(),
				'parent'        => $general_meta_box
			)
		);
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_audio_page_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Enable  Audio Page', 'cinerama' ),
				'description'   => esc_html__( 'This option works only for Coming Soon Page Template', 'cinerama' ),
				'parent'        => $general_meta_box,
				'options'       => cinerama_edge_get_yes_no_select_array()
			)
		);
		
		$audio_page_meta = cinerama_edge_add_admin_container(
			array(
				'parent'          => $general_meta_box,
				'name'            => 'audio_page_meta',
				'dependency' => array(
					'hide' => array(
						'edgtf_audio_page_meta'  => array('','no')
					)
				)
			)
		);
		
			$edgtf_audio_embedded_container = cinerama_edge_add_admin_container(
				array(
					'parent' => $audio_page_meta,
					'name'   => 'edgtf_audio_embedded_container'
				)
			);
			
			cinerama_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_page_audio_custom_meta',
					'type'        => 'text',
					'label'       => esc_html__( 'Audio Link', 'cinerama' ),
					'description' => esc_html__( 'Enter audio link (mp3)', 'cinerama' ),
					'parent'      => $edgtf_audio_embedded_container,
				)
			);
			
		
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'    => 'edgtf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'cinerama' ),
				'parent'  => $general_meta_box,
				'options' => cinerama_edge_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = cinerama_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'edgtf_boxed_meta'  => array('','no')
						)
					)
				)
			);
		
				cinerama_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'cinerama' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'cinerama' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				cinerama_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'cinerama' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'cinerama' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				cinerama_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'cinerama' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'cinerama' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				cinerama_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'cinerama' ),
						'description'   => esc_html__( 'Choose background image attachment', 'cinerama' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'cinerama' ),
							'fixed'  => esc_html__( 'Fixed', 'cinerama' ),
							'scroll' => esc_html__( 'Scroll', 'cinerama' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'cinerama' ),
				'parent'        => $general_meta_box,
				'options'       => cinerama_edge_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = cinerama_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'edgtf_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'edgtf_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				cinerama_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'cinerama' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'cinerama' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				cinerama_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'cinerama' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'cinerama' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				cinerama_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'cinerama' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'cinerama' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				cinerama_edge_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'edgtf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'cinerama' ),
						'options'       => cinerama_edge_get_yes_no_select_array(),
					)
				);
		
				cinerama_edge_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'edgtf_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'cinerama' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'cinerama' ),
						'options'       => cinerama_edge_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Content Width Layout - begin **********************/
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'cinerama' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'cinerama' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'cinerama' ),
					'edgtf-grid-1300' => esc_html__( '1300px', 'cinerama' ),
					'edgtf-grid-1200' => esc_html__( '1200px', 'cinerama' ),
					'edgtf-grid-1100' => esc_html__( '1100px', 'cinerama' ),
					'edgtf-grid-1000' => esc_html__( '1000px', 'cinerama' ),
					'edgtf-grid-800'  => esc_html__( '800px', 'cinerama' )
				)
			)
		);
		
		/***************** Content Width Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'cinerama' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'cinerama' ),
				'parent'        => $general_meta_box,
				'options'       => cinerama_edge_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = cinerama_edge_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'edgtf_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				cinerama_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'cinerama' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'cinerama' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => cinerama_edge_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = cinerama_edge_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'edgtf_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					cinerama_edge_create_meta_box_field(
						array(
							'name'   => 'edgtf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'cinerama' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = cinerama_edge_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'cinerama' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'cinerama' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = cinerama_edge_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					cinerama_edge_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'edgtf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'cinerama' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'cinerama' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'cinerama' ),
								'pulse'                 => esc_html__( 'Pulse', 'cinerama' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'cinerama' ),
								'cube'                  => esc_html__( 'Cube', 'cinerama' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'cinerama' ),
								'stripes'               => esc_html__( 'Stripes', 'cinerama' ),
								'wave'                  => esc_html__( 'Wave', 'cinerama' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'cinerama' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'cinerama' ),
								'atom'                  => esc_html__( 'Atom', 'cinerama' ),
								'clock'                 => esc_html__( 'Clock', 'cinerama' ),
								'mitosis'               => esc_html__( 'Mitosis', 'cinerama' ),
								'lines'                 => esc_html__( 'Lines', 'cinerama' ),
								'fussion'               => esc_html__( 'Fussion', 'cinerama' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'cinerama' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'cinerama' ),
								'camera'                => esc_html__( 'Camera', 'cinerama' )
							)
						)
					);
					
					cinerama_edge_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'edgtf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'cinerama' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					cinerama_edge_create_meta_box_field(
						array(
							'name'        => 'edgtf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'cinerama' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'cinerama' ),
							'options'     => cinerama_edge_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		cinerama_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'cinerama' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'cinerama' ),
				'parent'      => $general_meta_box,
				'options'     => cinerama_edge_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'cinerama_edge_action_meta_boxes_map', 'cinerama_edge_map_general_meta', 10 );
}

if ( ! function_exists( 'cinerama_edge_container_background_style' ) ) {
	/**
	 * Function that return container style
	 */
	function cinerama_edge_container_background_style( $style ) {
		$page_id      = cinerama_edge_get_page_id();
		$class_prefix = cinerama_edge_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .edgtf-content'
		);
		
		$container_class        = array();
		$page_background_color  = get_post_meta( $page_id, 'edgtf_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'edgtf_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'edgtf_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}
		
		$current_style = cinerama_edge_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'cinerama_edge_filter_add_page_custom_style', 'cinerama_edge_container_background_style' );
}