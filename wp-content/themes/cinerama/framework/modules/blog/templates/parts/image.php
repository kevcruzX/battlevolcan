<?php
$image_size          = isset( $image_size ) ? $image_size : 'full';
$image_meta          = get_post_meta( get_the_ID(), 'edgtf_blog_list_featured_image_meta', true );
$has_featured        = ! empty( $image_meta ) || has_post_thumbnail();
$blog_list_image_id  = ! empty( $image_meta ) && cinerama_edge_blog_item_has_link() ? cinerama_edge_get_attachment_id_from_url( $image_meta ) : '';
$show_image_caption  = ! empty( $show_image_caption ) ? true : false;
?>

<?php if ( $has_featured ) { ?>
	<div class="edgtf-post-image">
		<?php if ( cinerama_edge_blog_item_has_link() ) { ?>
            <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php } ?>
			<?php if ( ! empty( $blog_list_image_id ) ) {
				echo wp_get_attachment_image( $blog_list_image_id, $image_size );
			} else {
				the_post_thumbnail( $image_size );
			} ?>
				<?php if ( $show_image_caption && $image_caption = get_the_post_thumbnail_caption( get_the_ID() ) ) { ?>
				<div class="edgtf-post-image-caption"><?php echo esc_html($image_caption); ?></div>
			<?php } ?>
		<?php if ( cinerama_edge_blog_item_has_link() ) { ?>
			</a>
		<?php } ?>
		<?php do_action('cinerama_edge_action_blog_inside_image_tag')?>
	</div>
<?php } ?>