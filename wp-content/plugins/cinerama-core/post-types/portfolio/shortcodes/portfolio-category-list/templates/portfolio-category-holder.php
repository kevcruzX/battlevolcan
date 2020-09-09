<div class="edgtf-portfolio-category-list-holder <?php echo esc_attr( $holder_classes ); ?>">
	<div class="edgtf-pcl-inner edgtf-outer-space clearfix">
		<?php
			if ( ! empty( $query_results ) ) {
				foreach ( $query_results as $query ) {
					$termID            = $query->term_id;
					$params['image']   = get_term_meta( $termID, 'edgtf_portfolio_category_image_meta', true );
					$params['title']   = $query->name;
					$params['excerpt'] = $query->description;
					?>
					<article class="edgtf-pcl-item edgtf-item-space">
						<div class="edgtf-pcl-item-inner">
							<?php echo cinerama_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/image', '', $params ); ?>
							<div class="edgtf-pcli-text-holder">
								<div class="edgtf-pcli-text-wrapper">
									<div class="edgtf-pcli-text">
										<?php echo cinerama_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/title', '', $params ); ?>
										<?php echo cinerama_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/excerpt', '', $params ); ?>
									</div>
								</div>
							</div>
							<a itemprop="url" class="edgtf-pcli-link" href="<?php echo get_term_link( $termID ); ?>"></a>
						</div>
					</article>
				<?php }
			} else {
				echo cinerama_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/posts-not-found', '', $params );
			}
		?>
	</div>
</div>