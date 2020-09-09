<?php
$post_classes[] = 'edgtf-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
	<div class="edgtf-post-content">
		<div class="edgtf-post-heading">
			<?php cinerama_edge_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
		</div>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<div class="edgtf-post-info-top">
					<?php cinerama_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
					<?php cinerama_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
				</div>
				<div class="edgtf-post-text-main">
					<?php cinerama_edge_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
					<?php cinerama_edge_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
					<?php do_action('cinerama_edge_action_single_link_pages'); ?>
				</div>
			</div>
		</div>
	</div>
</article>