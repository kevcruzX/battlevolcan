<article class="edgtf-pcl-item edgtf-item-space">
	<div class="edgtf-pcl-item-inner">
		<?php echo cinerama_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-category-list', 'parts/image', '', $params); ?>
		
		<div class="edgtf-pcli-text-holder">
			<div class="edgtf-pcli-text-wrapper">
				<div class="edgtf-pcli-text">
					<?php echo cinerama_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-category-list', 'parts/title', '', $params); ?>
				</div>
			</div>
		</div>
		
		<a itemprop="url" class="edgtf-pcl-link" href="<?php echo get_the_permalink(); ?>"></a>
	</div>
</article>