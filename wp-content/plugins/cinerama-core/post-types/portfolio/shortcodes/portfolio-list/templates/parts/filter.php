<?php if($filter == 'yes') {
	$filter_categories    = $this_object->getFilterCategories($params);
	$filter_holder_styles = $this_object->getFilterHolderStyles($params);
	$filter_styles        = $this_object->getFilterStyles($params);
	?>
	<div class="edgtf-pl-filter-holder" <?php cinerama_edge_inline_style($filter_holder_styles); ?>>
		<div class="edgtf-plf-inner">
			<?php
			if(is_array($filter_categories) && count($filter_categories)){ ?>
				<ul <?php cinerama_edge_inline_style($filter_styles); ?>>
					<li class="edgtf-pl-filter" data-filter="">
						<span><?php esc_html_e('Show all', 'cinerama-core')?></span>
					</li>
					<?php foreach($filter_categories as $cat) { ?>
						<li class="edgtf-pl-filter" data-filter=".portfolio-category-<?php echo esc_attr($cat->slug); ?>">
							<span><?php echo esc_html($cat->name); ?></span>
						</li>
					<?php } ?>
				</ul>
			<?php } ?>
		</div>
	</div>
<?php } ?>
