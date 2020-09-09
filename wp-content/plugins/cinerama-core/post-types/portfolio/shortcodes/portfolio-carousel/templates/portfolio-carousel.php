<div class="edgtf-portfolio-carousel-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="edgtf-portfolio-carousel-inner edgtf-owl-slider" <?php echo cinerama_edge_get_inline_attrs( $carousel_data, true ); ?>>
		<?php
			$i    = 0;
			$rand = rand( 100, 40000 );

			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();

						$itemClasses = '';
						if ( $this_object->isVideoLink() ) {
							$itemClasses = 'edgtf-has-video';
						}
						?>
						<div class="edgtf-portfolio-carousel-item <?php echo esc_attr( $itemClasses ); ?>">
							<div class="edgtf-portfolio-carousel-item-inner">
								<?php echo cinerama_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-carousel', 'parts/image', '', $params); ?>
								<?php echo cinerama_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-carousel', 'parts/title', '', $params); ?>
								<a itemprop="url" class="edgtf-portfolio-carousel-link edgtf-block-drag-link" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>"></a>
							</div>
						</div>
						<?php $i ++;
				endwhile;
			else: ?>
				<p class="edgtf-portfolio-carousel-not-found"><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'cinerama-core' ); ?></p>
			<?php endif;

			wp_reset_postdata();
		?>
	</div>
</div>