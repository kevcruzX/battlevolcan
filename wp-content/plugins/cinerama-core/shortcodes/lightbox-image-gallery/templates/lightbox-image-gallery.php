<div class="edgtf-lig-holder <?php echo esc_attr( $holder_classes ); ?>">
	<div class="edgtf-lig-inner edgtf-outer-space ">
		<?php if ( ! empty( $items ) ) {
			$i    = 0;
			$rand = rand( 100, 40000 );
			
			foreach ( $items as $item ) {
				if ( isset( $item['image'] ) && ! empty( $item['image'] ) ) {
					$imageURL    = wp_get_attachment_image_url( $item['image'], 'full' );
					$itemLink    = isset( $item['link'] ) && ! empty( $item['link'] ) ? $item['link'] : $imageURL;
					$itemTitle   = isset( $item['title'] ) && ! empty( $item['title'] ) ? $item['title'] : '';
					$video_src   = strpos( $itemLink, '.mp4' ) !== false ? $itemLink : '';
					$itemClasses = ! empty( $video_src ) ? 'edgtf-has-video' : '';
					?>
					<div class="edgtf-lig-item edgtf-item-space <?php echo esc_attr( $itemClasses ); ?>">
						<a itemprop="url" class="edgtf-lig-item-link" href="<?php echo esc_url( $itemLink ); ?>" title="<?php echo esc_attr( $itemTitle ); ?>" data-rel="prettyPhoto[lig_pretty_photo-<?php echo esc_attr( $rand ); ?>]">
							<?php echo wp_get_attachment_image( $item['image'], 'full' ); ?>
							
							<?php if ( ! empty( $video_src ) ) { ?>
								<div class="edgtf-self-hosted-video-holder">
									<div class="edgtf-video-wrap">
										<video class="edgtf-self-hosted-video" poster="<?php echo esc_url( $imageURL ); ?>" preload="auto">
											<source type="video/mp4" src="<?php echo esc_url( $video_src ); ?>">
										</video>
									</div>
								</div>
							<?php } ?>
						</a>
					</div>
				<?php }
				$i ++;
			}
		} ?>
	</div>
</div>