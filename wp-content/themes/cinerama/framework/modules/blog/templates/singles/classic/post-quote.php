<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
        <div class="edgtf-post-text">
            <div class="edgtf-post-text-inner">
                <div class="edgtf-post-text-main">
                    <?php cinerama_edge_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
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
    <div class="edgtf-post-additional-content">
        <?php the_content(); ?>
    </div>
</article>