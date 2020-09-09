<div class="edgtf-call-to-action-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="edgtf-cta-inner <?php echo esc_attr($inner_classes); ?>">
		<div class="edgtf-cta-text-holder">
			<div class="edgtf-cta-text"><?php echo do_shortcode($content); ?></div>
		</div>
		<div class="edgtf-cta-button-holder" <?php echo cinerama_edge_get_inline_style($button_holder_styles); ?>>
			<div class="edgtf-cta-button"><?php echo cinerama_edge_get_button_html($button_parameters); ?></div>
		</div>
	</div>
</div>