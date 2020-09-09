<?php
$image_size        = isset( $image_size ) ? $image_size : 'full';
$image_gallery_val = get_post_meta( get_the_ID(), 'edgtf_post_gallery_images_meta', true );
?>

<?php if ( ! empty( $image_gallery_val ) ) { ?>
	<div class="edgtf-post-image">
		<div class="edgtf-blog-gallery edgtf-owl-slider">
			<?php
			$image_gallery_array = explode( ',', $image_gallery_val );
			
			if ( isset( $image_gallery_array ) && count( $image_gallery_array ) > 0 ):
				foreach ( $image_gallery_array as $gimg_id ): ?>
					<div>
						<?php if ( cinerama_edge_blog_item_has_link() ) { ?>
							<a itemprop="url" href="<?php the_permalink(); ?>">
						<?php } ?>
							<?php echo wp_get_attachment_image( $gimg_id, $image_size ); ?>
						<?php if ( cinerama_edge_blog_item_has_link() ) { ?>
							</a>
						<?php } ?>
					</div>
				<?php endforeach;
			endif;
			?>
		</div>
	</div>
<?php }
else {
    cinerama_edge_get_module_template_part('templates/parts/media', 'blog', '', '');
 } ?>
