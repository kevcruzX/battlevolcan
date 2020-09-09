<div class="<?php echo esc_attr( $blog_classes ) ?>" <?php echo esc_attr( $blog_data_params ) ?>>
	<div class="edgtf-blog-holder-inner edgtf-outer-space">
		<div class="edgtf-blog-masonry-grid-sizer"></div>
		<div class="edgtf-blog-masonry-grid-gutter"></div>
		<?php
		if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			cinerama_edge_get_post_format_html( $blog_type );
		endwhile;
		else:
			cinerama_edge_get_module_template_part( 'templates/parts/no-posts', 'blog' );
		endif;
		
		wp_reset_postdata();
		?>
	</div>
	<?php cinerama_edge_get_module_template_part( 'templates/parts/pagination/pagination', 'blog', '', $params ); ?>
</div>