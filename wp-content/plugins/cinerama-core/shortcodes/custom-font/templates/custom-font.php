<<?php echo esc_attr( $title_tag ); ?> class="edgtf-custom-font-holder <?php echo esc_attr( $holder_classes ); ?>" <?php cinerama_edge_inline_style( $holder_styles ); ?> <?php echo cinerama_edge_get_inline_attrs( $holder_data ); ?>>
	<?php echo wp_kses_post( $title ); ?>
</<?php echo esc_attr( $title_tag ); ?>>