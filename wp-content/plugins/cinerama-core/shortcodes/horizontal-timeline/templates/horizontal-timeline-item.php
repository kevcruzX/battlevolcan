<li data-date="<?php echo esc_attr( $date ) ?>">
	<div class="edgtf-hti-content-inner <?php echo esc_attr( $holder_classes ); ?>">
		<?php if ( ! empty( $content_image ) ): ?>
			<div class="edgtf-hti-content-image">
				<?php echo wp_get_attachment_image( $content_image, 'full' ); ?>
			</div>
		<?php endif; ?>
		<div class="edgtf-hti-content-value">
			<?php echo do_shortcode( $content ); ?>
		</div>
	</div>
</li>