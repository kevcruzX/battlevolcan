<?php
	cinerama_edge_get_single_post_format_html( $blog_single_type );
	do_action( 'cinerama_edge_action_after_article_content' );
?>
<div class="edgtf-grid-800">
	<div class="edgtf-grid">
		<?php
		cinerama_edge_get_module_template_part( 'templates/parts/single/single-navigation', 'blog' );
		
		cinerama_edge_get_module_template_part( 'templates/parts/single/comments', 'blog' );
		?>
	</div>
</div>
<?php cinerama_edge_get_module_template_part( 'templates/parts/single/related-posts', 'blog', 'classic', $single_info_params );