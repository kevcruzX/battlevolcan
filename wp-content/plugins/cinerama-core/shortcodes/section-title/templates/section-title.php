<div class="edgtf-section-title-holder <?php echo esc_attr($holder_classes); ?>" <?php echo cinerama_edge_get_inline_style($holder_styles); ?>>
	<div class="edgtf-st-inner">
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="edgtf-st-title" <?php echo cinerama_edge_get_inline_style($title_styles); ?>>
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<<?php echo esc_attr($text_tag); ?> class="edgtf-st-text" <?php echo cinerama_edge_get_inline_style($text_styles); ?>>
				<?php echo esc_html($text); ?>
			</<?php echo esc_attr($text_tag); ?>>
		<?php } ?>
	</div>
</div>