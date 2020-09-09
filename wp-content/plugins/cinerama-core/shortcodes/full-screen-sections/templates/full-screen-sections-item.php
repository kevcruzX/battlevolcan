<div class="edgtf-fss-item <?php echo esc_attr($holder_classes); ?>" <?php echo cinerama_edge_get_inline_attrs($holder_data); ?> <?php cinerama_edge_inline_style($holder_styles); ?>>
	<div class="edgtf-fss-item-inner" <?php cinerama_edge_inline_style($item_inner_styles); ?>>
		<?php echo do_shortcode($content); ?>
	</div>
	<?php if(!empty($link)) { ?>
		<a itemprop="url" class="edgtf-fss-item-link" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($link_target); ?>"></a>
	<?php } ?>
</div>