<div class="edgtf-interactive-image-with-text-holder <?php echo esc_attr( $holder_classes ); ?>">
	<?php if ( ! empty( $prefix_text ) ) { ?>
		<div class="edgtf-iiwt-prefix-holder">
			<div class="edgtf-iiwt-prefix-inner" <?php echo cinerama_edge_get_inline_style( $prefix_text_styles ); ?>>
				<svg class="edgtf-iiwt-prefix-text"><text><?php echo esc_html( $prefix_text ); ?></text></svg>
			</div>
		</div>
	<?php } ?>
	<div class="edgtf-iiwt-inner">
		<div class="edgtf-iiwt-image">
			<?php if ( ! empty( $custom_link ) ) { ?>
				<a itemprop="url" href="<?php echo esc_url( $custom_link ); ?>" target="<?php echo esc_attr( $custom_link_target ); ?>">
			<?php } ?>
				<?php if ( is_array( $image_size ) && count( $image_size ) ) : ?>
					<?php echo cinerama_edge_generate_thumbnail( $image, null, $image_size[0], $image_size[1] ); ?>
				<?php else: ?>
					<?php echo wp_get_attachment_image( $image, $image_size ); ?>
				<?php endif; ?>
			<?php if ( ! empty( $custom_link ) ) { ?>
				</a>
			<?php } ?>
		</div>
		<div class="edgtf-iiwt-content">
			<?php if ( ! empty( $title ) ) { ?>
				<<?php echo esc_attr( $title_tag ); ?> class="edgtf-iiwt-title" <?php echo cinerama_edge_get_inline_style( $title_styles ); ?>><?php echo esc_html( $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
			<?php } ?>
			<?php if ( ! empty( $text ) ) { ?>
				<p class="edgtf-iiwt-text" <?php echo cinerama_edge_get_inline_style( $text_styles ); ?>><?php echo esc_html( $text ); ?></p>
			<?php } ?>
			<?php if ( ! empty( $button_text ) && ! empty( $button_link ) ) { ?>
				<div class="edgtf-iiwt-button" <?php echo cinerama_edge_get_inline_style( $button_holder_styles ); ?>>
					<?php echo cinerama_edge_get_button_html( $button_parameters ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>