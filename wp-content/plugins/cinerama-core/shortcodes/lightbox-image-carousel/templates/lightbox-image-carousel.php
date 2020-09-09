<div class="edgtf-lic-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="edgtf-lic-inner edgtf-owl-slider" <?php echo cinerama_edge_get_inline_attrs( $carousel_data, true ); ?>>
		<?php if ( ! empty( $carousel_items ) ) {
			$i    = 0;
			$rand = rand( 100, 40000 );
			
			foreach ( $carousel_items as $item ) {
				$itemClasses = '';
				if ( $item['is_video_link'] === 'yes' ) {
					$itemClasses = 'edgtf-has-video';
				}
				
				$itemLink  = isset( $item['link'] ) && ! empty( $item['link'] ) ? $item['link'] : '#';
				$itemTitle = isset( $item['title'] ) && ! empty( $item['title'] ) ? $item['title'] : '';
				?>
				<div class="edgtf-lic-item <?php echo esc_attr( $itemClasses ); ?>">
					<a itemprop="url" class="edgtf-lic-item-link" href="<?php echo esc_url( $itemLink ); ?>" title="<?php echo esc_attr( $itemTitle ); ?>" data-rel="prettyPhoto[lic_pretty_photo-<?php echo esc_attr( $rand ); ?>]">
						<?php echo wp_get_attachment_image( $item['image'], 'full' ); ?>
					</a>
				</div>
				<?php $i ++;
			}
		} ?>
	</div>
</div>