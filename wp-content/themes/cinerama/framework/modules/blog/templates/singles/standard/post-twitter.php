<?php
$post_link = get_post_meta( get_the_ID(), 'edgtf_post_link_link_meta', true );

$post_classes[] = 'edgtf-twitter-post-format';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
    <div class="edgtf-post-content">
        <div class="edgtf-post-text">
            <div class="edgtf-post-text-inner">
                <h6 class="edgtf-post-twitter-author"><?php esc_html_e( '@', 'cinerama'); ?><?php echo esc_html( $twitter_author ); ?></h6>
	            <?php if ( ! empty( $post_link ) ) { ?>
                    <a itemprop="url" href="<?php echo esc_url($post_link); ?>" title="<?php the_title_attribute(); ?>" target="_blank">
                <?php } ?>
	                <?php cinerama_edge_get_module_template_part( 'templates/parts/title', 'blog', '', $part_params ); ?>
                <?php if ( ! empty( $post_link ) ) { ?>
                    </a>
                <?php } ?>
				<p class="edgtf-post-twitter-text"><?php echo wp_kses_post( $twitter_text ); ?></p>
				<p class="edgtf-post-twitter-date"><?php echo esc_html( $twitter_time ); ?></p>
            </div>
        </div>
    </div>
    <div class="edgtf-post-additional-content">
        <?php the_content(); ?>
    </div>
	<div class="edgtf-post-info-bottom clearfix">
		<div class="edgtf-post-info-bottom-left">
			<?php cinerama_edge_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
		</div>
		<div class="edgtf-post-info-bottom-center">
			<?php cinerama_edge_get_module_template_part('templates/parts/post-info/comments', 'blog', '', $part_params); ?>
			<?php cinerama_edge_get_module_template_part('templates/parts/post-info/like', 'blog', '', $part_params); ?>
		</div>
		<div class="edgtf-post-info-bottom-right">
			<?php cinerama_edge_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
		</div>
	</div>
</article>