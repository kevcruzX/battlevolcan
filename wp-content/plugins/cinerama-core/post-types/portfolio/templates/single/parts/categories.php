<?php if(cinerama_edge_options()->getOptionValue('portfolio_single_enable_categories') === 'yes') : ?>
    <?php
    $categories   = wp_get_post_terms(get_the_ID(), 'portfolio-category');
    if(is_array($categories) && count($categories)) : ?>
        <div class="edgtf-ps-info-item edgtf-ps-categories">
	        <?php cinerama_core_get_cpt_single_module_template_part('templates/single/parts/info-title', 'portfolio', '', array( 'title' => esc_attr__('Category:', 'cinerama-core') ) ); ?>
            <div class="edgtf-ps-info-value-holder">
		        <?php foreach($categories as $cat) { ?>
	                <a itemprop="url" class="edgtf-ps-info-category" target="_blank" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
	            <?php } ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
