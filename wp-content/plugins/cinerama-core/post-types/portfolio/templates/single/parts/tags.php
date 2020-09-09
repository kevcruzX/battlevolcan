<?php if(cinerama_edge_options()->getOptionValue('portfolio_single_enable_tags') === 'yes') : ?>
	<?php
	$tags = wp_get_post_terms(get_the_ID(), 'portfolio-tag');
	$tag_names = array();

	if(is_array($tags) && count($tags)) : ?>
	    <div class="edgtf-ps-info-item edgtf-ps-tags">
		    <?php cinerama_core_get_cpt_single_module_template_part('templates/single/parts/info-title', 'portfolio', '', array( 'title' => esc_attr__('Tags:', 'cinerama-core') ) ); ?>
	        <div class="edgtf-ps-info-value-holder">
		        <?php foreach($tags as $tag) { ?>
	                <a itemprop="url" class="edgtf-ps-info-tag" target="_blank" href="<?php echo esc_url(get_term_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a>
	            <?php } ?>
	        </div>
	    </div>
	<?php endif; ?>
<?php endif; ?>
