<li class="edgtf-bl-item edgtf-item-space clearfix">
	<div class="edgtf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			cinerama_edge_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
		<div class="edgtf-bli-content">
			<?php cinerama_edge_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
			<?php cinerama_edge_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params ); ?>
		</div>
	</div>
</li>