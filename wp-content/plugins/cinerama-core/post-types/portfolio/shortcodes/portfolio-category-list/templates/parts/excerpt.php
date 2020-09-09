<?php if ( ! empty( $excerpt ) ) { ?>
	<p itemprop="description" class="edgtf-pcli-excerpt"><?php echo wp_kses_post( $excerpt ); ?></p>
<?php } ?>