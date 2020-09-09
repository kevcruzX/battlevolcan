<?php
$related_post_number = cinerama_edge_sidebar_layout() === 'no-sidebar' ? 3 : 2;
$related_posts_options = array(
    'posts_per_page' => $related_post_number
);
$related_posts = cinerama_edge_get_blog_related_post_type(get_the_ID(), $related_posts_options);
$related_posts_image_size = isset($related_posts_image_size) ? $related_posts_image_size : 'full';
?>
<div class="edgtf-related-posts-holder clearfix">
    <div class="edgtf-related-posts-holder-inner">
        <?php if ( $related_posts && $related_posts->have_posts() ) : ?>
            <div class="edgtf-related-posts-title">
                <h4><?php esc_html_e('Related Articles', 'cinerama' ); ?></h4>
            </div>
            <div class="edgtf-related-posts-inner clearfix">
                <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                    <div class="edgtf-related-post">
                        <div class="edgtf-related-post-inner">
		                    <?php if (has_post_thumbnail()) { ?>
                            <div class="edgtf-related-post-image">
                                <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                     <?php the_post_thumbnail($related_posts_image_size); ?>
                                </a>
                            </div>
		                    <?php }	?>
                            <div class="edgtf-post-info">
	                            <div class="edgtf-post-info-time">
		                            <?php echo human_time_diff( get_post_time( 'U' ), current_time( 'timestamp' ) ) . esc_html__( ' ago', 'cinerama' ); ?>
	                            </div>
	                            <?php cinerama_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $params); ?>
                            </div>
                            <h4 itemprop="name" class="entry-title edgtf-post-title"><a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                            <div class="edgtf-post-excerpt">
                                <?php cinerama_edge_get_module_template_part('templates/parts/excerpt', 'blog', '', $params); ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif;
        wp_reset_postdata();
        ?>
    </div>
</div>