<?php get_header(); ?>
<div class="edgtf-page-not-found">
	<?php
	$edgtf_title_image_404 = cinerama_edge_options()->getOptionValue( '404_page_title_image' );
	$edgtf_tagline_404     = cinerama_edge_options()->getOptionValue( '404_tagline' );
	$edgtf_title_404       = cinerama_edge_options()->getOptionValue( '404_title' );
	$edgtf_subtitle_404    = cinerama_edge_options()->getOptionValue( '404_subtitle' );
	$edgtf_text_404        = cinerama_edge_options()->getOptionValue( '404_text' );
	$edgtf_button_label    = cinerama_edge_options()->getOptionValue( '404_back_to_home' );
	$edgtf_button_style    = cinerama_edge_options()->getOptionValue( '404_button_style' );
	
	if ( ! empty( $edgtf_title_image_404 ) ) { ?>
		<div class="edgtf-404-title-image">
			<img src="<?php echo esc_url( $edgtf_title_image_404 ); ?>" alt="<?php esc_attr_e( '404 Title Image', 'cinerama' ); ?>" />
		</div>
	<?php } ?>

	<p class="edgtf-404-tagline">
		<?php if ( ! empty( $edgtf_tagline_404 ) ) {
			echo esc_html( $edgtf_tagline_404 );
		} else {
			esc_html_e( 'Error page', 'cinerama' );
		} ?>
	</p>

	<h1 class="edgtf-404-title">
		<?php if ( ! empty( $edgtf_title_404 ) ) {
			echo esc_html( $edgtf_title_404 );
		} else {
			esc_html_e( '404', 'cinerama' );
		} ?>
	</h1>
	
	<h3 class="edgtf-404-subtitle">
		<?php if ( ! empty( $edgtf_subtitle_404 ) ) {
			echo esc_html( $edgtf_subtitle_404 );
		} else {
			esc_html_e( 'Page can not be found', 'cinerama' );
		} ?>
	</h3>
	
	<p class="edgtf-404-text">
		<?php if ( ! empty( $edgtf_text_404 ) ) {
			echo esc_html( $edgtf_text_404 );
		} else {
			esc_html_e( 'The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'cinerama' );
		} ?>
	</p>
	
	<?php
		$button_params = array(
			'type'               => 'outline',
			'hover_animation'    => 'yes',
			'link'               => esc_url( home_url( '/' ) ),
			'text'               => ! empty( $edgtf_button_label ) ? $edgtf_button_label : esc_html__( 'Back to homepage', 'cinerama' )
		);
	
		if ( $edgtf_button_style == 'light-style' ) {
			$button_params['custom_class'] = 'edgtf-btn-light-style';
		}
		
		echo cinerama_edge_return_button_html( $button_params );
	?>
</div>
<?php get_footer(); ?>