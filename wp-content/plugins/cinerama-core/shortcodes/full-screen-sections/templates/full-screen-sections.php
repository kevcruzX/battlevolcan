<div class="edgtf-full-screen-sections <?php echo esc_attr($holder_classes); ?>" <?php echo cinerama_edge_get_inline_attrs($holder_data); ?>>
	<div class="edgtf-fss-wrapper">
		<?php echo do_shortcode($content); ?>
	</div>
	<?php if($enable_navigation === 'yes') { ?>
		<div class="edgtf-fss-nav-holder">
			<a id="edgtf-fss-nav-up" href="#"><span class='icon-arrows-up'></span></a>
			<a id="edgtf-fss-nav-down" href="#"><span class='icon-arrows-down'></span></a>
		</div>
	<?php } ?>
</div>