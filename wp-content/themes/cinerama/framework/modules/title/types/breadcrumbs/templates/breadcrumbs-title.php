<?php do_action('cinerama_edge_action_before_page_title'); ?>

<div class="edgtf-title-holder <?php echo esc_attr($holder_classes); ?>" <?php cinerama_edge_inline_style($holder_styles); ?> <?php echo cinerama_edge_get_inline_attrs($holder_data); ?>>
	<?php if(!empty($title_image)) { ?>
		<div class="edgtf-title-image">
			<img itemprop="image" src="<?php echo esc_url($title_image['src']); ?>" alt="<?php echo esc_attr($title_image['alt']); ?>" />
		</div>
	<?php } ?>
	<div class="edgtf-title-wrapper" <?php cinerama_edge_inline_style($wrapper_styles); ?>>
		<div class="edgtf-title-inner">
			<div class="edgtf-grid">
				<?php cinerama_edge_custom_breadcrumbs(); ?>
			</div>
	    </div>
	</div>
</div>

<?php do_action('cinerama_edge_action_after_page_title'); ?>
