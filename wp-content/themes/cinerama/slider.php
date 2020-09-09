<?php
do_action( 'cinerama_edge_action_before_slider_action' );

$edgtf_slider_shortcode = get_post_meta( cinerama_edge_get_page_id(), 'edgtf_page_slider_meta', true );

if ( ! empty( $edgtf_slider_shortcode ) ) { ?>
	<div class="edgtf-slider">
		<div class="edgtf-slider-inner">
			<?php echo do_shortcode( wp_kses_post( $edgtf_slider_shortcode ) ); // XSS OK ?>
		</div>
	</div>
<?php }

do_action( 'cinerama_edge_action_after_slider_action' );
?>