<?php if(cinerama_edge_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>
    <?php
	$back_to_link      = get_post_meta( get_the_ID(), 'portfolio_single_back_to_link', true );
	$nav_same_category = cinerama_edge_options()->getOptionValue( 'portfolio_single_nav_same_category' ) == 'yes';
	$nav_skin          = get_post_meta( get_the_ID(), 'edgtf_portfolio_single_navigation_skin_meta', true );
	$nav_skin_class    = ! empty( $nav_skin ) ? 'edgtf-ps-navigation-' . $nav_skin : '';
	?>
    <div class="edgtf-ps-navigation-holder <?php echo esc_attr($nav_skin_class); ?>">
	    <div class="edgtf-ps-navigation">
	        <?php if(get_previous_post() !== '') : ?>
	            <div class="edgtf-ps-prev">
	                <?php if($nav_same_category) {
	                    $prev_post = get_previous_post( true, '', 'portfolio-category' );
	                    $prev_post_thumbnail_id = get_post_thumbnail_id($prev_post->ID);
	                    $prev_post_thumbnail = cinerama_edge_generate_thumbnail($prev_post_thumbnail_id, '', '80', '48');
		                previous_post_link('%link','<span class="edgtf-ps-nav-image">'. $prev_post_thumbnail .'</span><span class="edgtf-ps-nav-label">' . esc_html__( "prev", "cinerama-core" ) . '</span>', true, '', 'portfolio-category');
	                } else {
	                    $prev_post = get_previous_post();
	                    $prev_post_thumbnail_id = get_post_thumbnail_id($prev_post->ID);
	                    $prev_post_thumbnail = cinerama_edge_generate_thumbnail($prev_post_thumbnail_id, '', '80', '48');
		                previous_post_link('%link','<span class="edgtf-ps-nav-image">'. $prev_post_thumbnail .'</span><span class="edgtf-ps-nav-label">' . esc_html__( "prev", "cinerama-core" ) . '</span>');
	                } ?>
	            </div>
	        <?php endif; ?>

	        <?php if($back_to_link !== '') : ?>
	            <div class="edgtf-ps-back-btn">
	                <a itemprop="url" href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
	                    <span class="fa fa-film"></span>
	                </a>
	            </div>
	        <?php endif; ?>

	        <?php if(get_next_post() !== '') : ?>
	            <div class="edgtf-ps-next">
	                <?php if($nav_same_category) {
	                    $next_post = get_next_post( true, '', 'portfolio-category' );
	                    $next_post_thumbnail_id = get_post_thumbnail_id($next_post->ID);
		                $next_post_thumbnail = cinerama_edge_generate_thumbnail($next_post_thumbnail_id, '', '80px', '48px');
	                    next_post_link('%link', '<span class="edgtf-ps-nav-label">' . esc_html__( "next", "cinerama-core" ) . '</span><span class="edgtf-ps-nav-image">'. $next_post_thumbnail .'</span>', true, '', 'portfolio-category');
	                } else {
	                    $next_post = get_next_post();
	                    $next_post_thumbnail_id = get_post_thumbnail_id($next_post->ID);
	                    $next_post_thumbnail = cinerama_edge_generate_thumbnail($next_post_thumbnail_id, '', '80px', '48px');
	                    next_post_link('%link', '<span class="edgtf-ps-nav-label">' . esc_html__( "next", "cinerama-core" ) . '</span><span class="edgtf-ps-nav-image">'. $next_post_thumbnail .'</span>');
	                } ?>
	            </div>
	        <?php endif; ?>
	    </div>
    </div>
<?php endif; ?>