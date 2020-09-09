<div class="edgtf-ils-holder <?php echo esc_attr( $holder_classes ); ?>">
	<?php if ( ! empty( $link_items ) ) { ?>
		<div class="edgtf-ils-image-holder" <?php cinerama_edge_inline_style( $image_holder_styles ); ?>>
			<?php foreach ( $link_items as $link_item ): ?>
				<?php if ( isset( $link_item['image'] ) ) { ?>
					<?php
						$item_style   = array();
						$item_style[] = 'background-image: url(' . wp_get_attachment_url( $link_item['image'] ) . ')';
					?>
					<div class="edgtf-ils-item-image" <?php cinerama_edge_inline_style( $item_style ); ?>>
						<?php echo wp_get_attachment_image( $link_item['image'], 'full' ); ?>
					</div>
				<?php } ?>
			<?php endforeach; ?>
		</div>
		<div class="edgtf-ils-content-holder">
			<div class="edgtf-ils-content-inner">
				<div class="edgtf-ils-item-content">
					<?php
						$i = 0;
						
						$lightbox_data = isset( $lightbox_link ) && $lightbox_link === 'yes' ? 'data-rel=prettyPhoto[ils_pretty_photo]' : '';
						
						foreach ( $link_items as $link_item ): ?>
						<?php if ( isset( $link_item['title'] ) ) { ?>
							<a itemprop="url" class="edgtf-ils-item-link" data-index="<?php echo esc_attr($i); ?>" href="<?php echo esc_url( $link_item['link'] ); ?>" <?php echo esc_attr( $lightbox_data ); ?> target="<?php echo esc_attr( $link_target ); ?>">
								<svg viewbox="0 0 1 1">
									<text x="0.5" y="0.75" font-size="1" text-anchor="middle" stroke-width="0.005"><?php echo esc_html( $link_item['title'] ); ?></text>
								</svg>
								<svg class="edgtf-ils-svg-clone" viewbox="0 0 1 1">
									<text x="0.5" y="0.75" font-size="1" text-anchor="middle" stroke-width="0.005"><?php echo esc_html( $link_item['title'] ); ?></text>
								</svg>
							</a>
						<?php
						$i++;
						} ?>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php } ?>
</div>