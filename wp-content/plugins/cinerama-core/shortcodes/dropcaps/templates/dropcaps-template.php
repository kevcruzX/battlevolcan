<?php
/**
 * Dropcaps shortcode template
 */
?>

<span class="edgtf-dropcaps <?php echo esc_attr($dropcaps_class);?>" <?php cinerama_edge_inline_style($dropcaps_style);?>>
	<span class="edgtf-dropcaps-inner">
		<?php echo esc_html($letter);?>
	</span>
</span>