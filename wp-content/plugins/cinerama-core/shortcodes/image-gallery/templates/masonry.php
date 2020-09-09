<?php
$i    = 0;
$rand = rand(0,1000);
?>
<div class="edgtf-image-gallery <?php echo esc_attr($holder_classes); ?>">
	<div class="edgtf-ig-inner edgtf-outer-space <?php echo esc_attr($inner_classes); ?>">
		<div class="edgtf-ig-grid-sizer"></div>
		<div class="edgtf-ig-grid-gutter"></div>
		<?php foreach ($images as $image) { ?>
			<?php
			$image_classes    = '';
			$image_size_class = get_post_meta( $image['image_id'], 'image_gallery_masonry_image_size', true );
			$new_image_size   = $image_size;
			
			if ( ! empty( $image_size_class ) ) {
				$image_classes = 'edgtf-masonry-size-' . esc_attr( $image_size_class );
				
				if ( $image_size_class === 'large-width-height' ) {
					$new_image_size = 'cinerama_edge_image_huge';
				} else if ( $image_size_class === 'small' ) {
					$new_image_size = 'cinerama_edge_image_square';
				} else if ( $image_size_class === 'large-width' ) {
					$new_image_size = 'cinerama_edge_image_landscape';
				} else if ( $image_size_class === 'large-height' ) {
					$new_image_size = 'cinerama_edge_image_portrait';
				} else {
					$new_image_size = 'full';
				}
			}
			?>
			<div class="edgtf-ig-image edgtf-item-space <?php echo esc_attr($image_classes); ?>">
				<div class="edgtf-ig-image-inner">
					<?php if ($image_behavior === 'lightbox') { ?>
						<a itemprop="image" class="edgtf-ig-lightbox" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[image_gallery_pretty_photo-<?php echo esc_attr($rand); ?>]" title="<?php echo esc_attr($image['title']); ?>">
					<?php } else if ($image_behavior === 'custom-link' && !empty($custom_links)) { ?>
						<a itemprop="url" class="edgtf-ig-custom-link" href="<?php echo esc_url($custom_links[$i++]); ?>" target="<?php echo esc_attr($custom_link_target); ?>" title="<?php echo esc_attr($image['title']); ?>">
					<?php } ?>
						<?php if(is_array($new_image_size) && count($new_image_size)) :
							echo cinerama_edge_generate_thumbnail($image['image_id'], null, $new_image_size[0], $new_image_size[1]);
						else:
							echo wp_get_attachment_image($image['image_id'], $new_image_size);
						endif; ?>
						<?php if ( ! empty( $image['caption'] ) ) { ?>
							<div class="edgtf-ig-caption"><?php echo esc_html($image['caption']); ?></div>
						<?php } ?>
					<?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>