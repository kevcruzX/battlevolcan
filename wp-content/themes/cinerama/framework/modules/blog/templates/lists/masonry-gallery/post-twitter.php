<?php
$image_proportion       = cinerama_edge_get_meta_field_intersect( 'blog_list_featured_image_proportion', cinerama_edge_get_page_id() );
$image_proportion_value = get_post_meta( get_the_ID(), 'edgtf_blog_masonry_gallery_' . $image_proportion . '_dimensions_meta', true );

if ( isset( $image_proportion_value ) && $image_proportion_value !== '' ) {
	$size           = $image_proportion_value !== '' ? $image_proportion_value : 'default';
	$post_classes[] = 'edgtf-masonry-size-' . $size;
} else {
	$size           = 'default';
	$post_classes[] = 'edgtf-masonry-size-small';
}

$post_link = get_post_meta( get_the_ID(), 'edgtf_post_link_link_meta', true );

$part_params['title_tag'] = 'h4';

$post_classes[] = 'edgtf-item-space edgtf-twitter-post-format';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
	<div class="edgtf-post-content">
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<h6 class="edgtf-post-twitter-author"><?php esc_html_e( '@', 'cinerama'); ?><?php echo esc_html( $twitter_author ); ?></h6>
				<?php cinerama_edge_get_module_template_part( 'templates/parts/title', 'blog', '', $part_params ); ?>
				<p class="edgtf-post-twitter-text"><?php echo wp_kses_post( $twitter_text ); ?></p>
				<p class="edgtf-post-twitter-date"><?php echo esc_html( $twitter_time ); ?></p>
			</div>
		</div>
		<?php if ( ! empty( $post_link ) ) { ?>
			<a itemprop="url" class="edgtf-blog-masonry-gallery-link" href="<?php echo esc_url( $post_link ); ?>"></a>
		<?php } ?>
	</div>
</article>
