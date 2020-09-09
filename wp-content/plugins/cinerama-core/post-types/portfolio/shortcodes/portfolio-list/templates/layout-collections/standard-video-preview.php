<div class="edgtf-pli-video-holder">
	<?php
	$single_upload = get_post_meta( get_the_ID(), 'edgtf_portfolio_single_upload', true );
	
	if ( is_array( $single_upload ) && count( $single_upload ) ) {
		foreach ( $single_upload as $item ) {
			if ( $item['file_type'] === 'video' ) {
				$type              = $item['video_type'];
				$video_src         = '';
				$video_cover_image = '';
				$flashmedia        = get_template_directory_uri() . '/assets/js/flashmediaelement.swf';
				$styles            = array();
				
				switch ( $type ) {
					case 'youtube':
						$video_src         = $item['video_id'];
						$video_cover_image = 'https://img.youtube.com/vi/' . trim( $item['video_id'] ) . '/sddefault.jpg';
						break;
					case 'vimeo';
						$video_src = $item['video_id'];
						
						$url      = 'https://vimeo.com/api/v2/video/' . $item['video_id'] . '.php';
						$request  = wp_remote_get($url);
						$response = unserialize( wp_remote_retrieve_body( $request ) );
						
						$video_cover_image = $response[0]['thumbnail_large'];
						
						break;
					case 'self':
						$video_src         = $item['video_mp4'];
						$video_cover_image = ! empty( $item['video_cover_image'] ) ? $item['video_cover_image'] : '';
						break;
				}
				
				if ( ! empty( $video_cover_image ) ) {
					$styles = 'background-image: url(' . esc_url( $video_cover_image ) . ' )'; ?>
					
					<div class="edgtf-pli-video-cover-image" <?php echo cinerama_edge_get_inline_style( $styles ); ?> data-type="<?php echo esc_attr( $type ); ?>"></div>
					
					<?php if ( $type === 'youtube' ) { ?>
						<iframe src="https://www.youtube.com/embed/<?php echo esc_url( $video_src ); ?>?wmode=transparent" width="800" height="600" frameborder="0" allowfullscreen></iframe>
					<?php } elseif ( $type === 'vimeo' ) { ?>
						<iframe src="https://player.vimeo.com/video/<?php echo esc_url( $video_src ); ?>?title=0&amp;byline=0&amp;portrait=0" width="800" height="600" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					<?php } elseif ( $type === 'self' ) { ?>
						<div class="edgtf-self-hosted-video-holder">
							<div class="edgtf-video-wrap">
								<video class="edgtf-self-hosted-video" poster="<?php echo esc_url( $video_cover_image ); ?>" preload="auto" controls>
									<source type="video/mp4" src="<?php echo esc_url( $video_src ); ?>">
								</video>
							</div>
						</div>
					<?php }
				}
			}
		}
	}
	?>
</div>
<div class="edgtf-pli-text-holder" <?php cinerama_edge_inline_style( $this_object->getStandardContentStyles( $params ) ); ?>>
	<div class="edgtf-pli-text-wrapper">
		<div class="edgtf-pli-text">
			<?php if ( $enable_title === 'yes' ) {
				$title_tag    = ! empty( $title_tag ) ? $title_tag : 'h4';
				$title_styles = $this_object->getTitleStyles( $params );
			?>
				<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="edgtf-pli-title entry-title" <?php cinerama_edge_inline_style( $title_styles ); ?>>
					<a itemprop="url" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>">
						<?php echo esc_attr( get_the_title() ); ?>
					</a>
				</<?php echo esc_attr( $title_tag ); ?>>
			<?php } ?>
			
			<?php echo cinerama_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'parts/category', $item_style, $params ); ?>
			
			<?php echo cinerama_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'parts/images-count', $item_style, $params ); ?>
			
			<?php echo cinerama_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'parts/excerpt', $item_style, $params ); ?>
		</div>
	</div>
</div>