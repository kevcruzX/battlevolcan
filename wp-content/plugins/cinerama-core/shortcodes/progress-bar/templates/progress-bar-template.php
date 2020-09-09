<div class="edgtf-progress-bar <?php echo esc_attr($holder_classes); ?>">
	<<?php echo esc_attr($title_tag); ?> class="edgtf-pb-title-holder" <?php echo cinerama_edge_inline_style($title_styles); ?>>
		<span class="edgtf-pb-title"><?php echo esc_html($title); ?></span>
		<span class="edgtf-pb-percent">0</span>
	</<?php echo esc_attr($title_tag); ?>>
	<div class="edgtf-pb-content-holder" <?php echo cinerama_edge_inline_style($inactive_bar_style); ?>>
		<div data-percentage=<?php echo esc_attr($percent); ?> class="edgtf-pb-content" <?php echo cinerama_edge_inline_style($active_bar_style); ?>></div>
	</div>
</div>