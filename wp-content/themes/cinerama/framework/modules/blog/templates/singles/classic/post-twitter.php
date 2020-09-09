<?php
$post_link = get_post_meta( get_the_ID(), 'edgtf_post_link_link_meta', true );

$post_classes[] = 'edgtf-twitter-post-format';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
    <div class="edgtf-post-content">
	    <div class="edgtf-post-top-section">
		    <div class="edgtf-post-info-top">
	            <?php cinerama_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
	            <?php cinerama_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
	        </div>
		    <?php if ( ! empty( $post_link ) ) { ?>
                <a itemprop="url" href="<?php echo esc_url($post_link); ?>" title="<?php the_title_attribute(); ?>" target="_blank">
            <?php } ?>
                <?php cinerama_edge_get_module_template_part( 'templates/parts/title', 'blog', '', $part_params ); ?>
            <?php if ( ! empty( $post_link ) ) { ?>
                </a>
            <?php } ?>
	    </div>
        <div class="edgtf-post-heading">
            <?php cinerama_edge_get_module_template_part('templates/parts/media', 'blog', $post_format, array_merge($part_params, array('show_image_caption' => true))); ?>
        </div>
	    <div class="edgtf-grid-800">
			<div class="edgtf-grid">
		        <div class="edgtf-post-text">
		            <div class="edgtf-post-text-inner">
			            <h6 class="edgtf-post-twitter-author"><?php esc_html_e( '@', 'cinerama'); ?><?php echo esc_html( $twitter_author ); ?></h6>
						<p class="edgtf-post-twitter-text"><?php echo wp_kses_post( $twitter_text ); ?></p>
						<p class="edgtf-post-twitter-date"><?php echo esc_html( $twitter_time ); ?></p>
		                <div class="edgtf-post-text-main">
		                    <?php the_content(); ?>
		                    <?php do_action('cinerama_edge_action_single_link_pages'); ?>
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
		            </div>
		        </div>
			</div>
	    </div>
    </div>
</article>