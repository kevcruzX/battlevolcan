<div class="edgtf-google-map-holder">
	<div class="edgtf-google-map" id="<?php echo esc_attr($map_id); ?>" <?php echo wp_kses($map_data, array('data')); ?>></div>
	<?php if ( $params['snazzy_map_style'] === 'yes' ) { ?>
		<input type="hidden" class="edgtf-snazzy-map" value="<?php echo str_replace( '<br />', '', $params['snazzy_map_code'] ); ?>" />
	<?php } ?>
	<?php if ($scroll_wheel == 'no') { ?>
		<div class="edgtf-google-map-overlay"></div>
	<?php } ?>
</div>
