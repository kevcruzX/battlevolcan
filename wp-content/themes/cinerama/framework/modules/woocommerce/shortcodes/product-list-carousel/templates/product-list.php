<?php
$shader_styles          = $this_object->getShaderStyles( $params );
$params['title_styles'] = $this_object->getTitleStyles( $params );
?>
<div class="edgtf-plc-holder <?php echo esc_attr( $holder_classes ) ?>">
	<div class="edgtf-plc-outer edgtf-owl-slider" <?php echo cinerama_edge_get_inline_attrs( $holder_data ); ?>>
		<?php if ( $query_result->have_posts() ): while ( $query_result->have_posts() ) : $query_result->the_post(); ?>
			<div class="edgtf-plc-item">
				<div class="edgtf-plc-image-outer">
					<div class="edgtf-plc-image">
						<?php cinerama_edge_get_module_template_part( 'templates/parts/image', 'woocommerce', '', $params ); ?>
					</div>
					<div class="edgtf-plc-text" <?php echo cinerama_edge_get_inline_style( $shader_styles ); ?>>
						<div class="edgtf-plc-text-outer">
							<div class="edgtf-plc-text-inner">
								<?php cinerama_edge_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>
								
								<?php cinerama_edge_get_module_template_part( 'templates/parts/category', 'woocommerce', '', $params ); ?>
								
								<?php cinerama_edge_get_module_template_part( 'templates/parts/excerpt', 'woocommerce', '', $params ); ?>
								
								<?php cinerama_edge_get_module_template_part( 'templates/parts/rating', 'woocommerce', '', $params ); ?>
								
								<?php cinerama_edge_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>
								
								<?php cinerama_edge_get_module_template_part( 'templates/parts/add-to-cart', 'woocommerce', '', $params ); ?>
							</div>
						</div>
					</div>
					<a class="edgtf-plc-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
				</div>
			</div>
		<?php endwhile;
		else:
			cinerama_edge_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
		endif;
		wp_reset_postdata();
		?>
	</div>
</div>