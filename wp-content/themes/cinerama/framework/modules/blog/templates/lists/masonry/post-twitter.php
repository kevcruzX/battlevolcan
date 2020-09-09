<?php
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
