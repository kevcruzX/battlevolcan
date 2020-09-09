<?php
$rand = rand(0, 1000);
$link_class = !empty($play_button_hover_image) ? 'edgtf-vb-has-hover-image' : '';
?>
<div class="edgtf-video-button-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="edgtf-video-button-image">
		<?php echo wp_get_attachment_image($video_image, 'full'); ?>
	</div>
	<?php if(!empty($play_button_image)) { ?>
		<a class="edgtf-video-button-play-image <?php echo esc_attr($link_class); ?>" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr($rand); ?>]">
			<span class="edgtf-video-button-play-inner">
				<?php echo wp_get_attachment_image($play_button_image, 'full'); ?>
				<?php if(!empty($play_button_hover_image)) { ?>
					<?php echo wp_get_attachment_image($play_button_hover_image, 'full'); ?>
				<?php } ?>
			</span>
		</a>
	<?php } else { ?>
		<a class="edgtf-video-button-play" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr($rand); ?>]">
			<span class="edgtf-video-button-play-inner">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="41.917px" height="45.998px" viewBox="0 0 41.917 45.998" enable-background="new 0 0 41.917 45.998" xml:space="preserve">
				<g>
					<path fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" d="M3.183,44.579
						c-0.864,0.474-1.561,0.056-1.561-0.921V2.623c0-0.977,0.697-1.395,1.561-0.921l37.022,20.574c0.864,0.474,0.864,1.255,0,1.729
						L3.183,44.579z"/>
				</g>
				</svg>
			</span>
		</a>
	<?php } ?>
</div>