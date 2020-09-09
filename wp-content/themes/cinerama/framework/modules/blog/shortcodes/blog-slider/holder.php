<div class="edgtf-blog-slider-holder <?php echo esc_attr( $slider_classes ); ?>">
	<ul class="edgtf-blog-slider edgtf-owl-slider" <?php echo cinerama_edge_get_inline_attrs( $slider_data ); ?>>
		<?php
		if ( $query_result->have_posts() ):
			while ( $query_result->have_posts() ) : $query_result->the_post();
				cinerama_edge_get_module_template_part( 'shortcodes/blog-slider/layout-collections/' . $slider_type, 'blog', '', $params );
			endwhile;
		else: ?>
			<div class="edgtf-blog-slider-message">
				<p><?php esc_html_e( 'No posts were found.', 'cinerama' ); ?></p>
			</div>
		<?php endif;
		
		wp_reset_postdata();
		?>
	</ul>
</div>
