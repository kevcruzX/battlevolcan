<?php
/*
Template Name: Coming Soon Page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * cinerama_edge_action_header_meta hook
	 *
	 * @see cinerama_edge_header_meta() - hooked with 10
	 * @see cinerama_edge_user_scalable_meta() - hooked with 10
	 * @see cinerama_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'cinerama_edge_action_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * cinerama_edge_action_after_body_tag hook
	 *
	 * @see cinerama_edge_get_side_area() - hooked with 10
	 * @see cinerama_edge_smooth_page_transitions() - hooked with 10
	 */
	do_action( 'cinerama_edge_action_after_body_tag' ); ?>
	<div class="edgtf-wrapper">
		<div class="edgtf-wrapper-inner">
			<div class="edgtf-content">
				<div class="edgtf-content-inner">
					<?php get_template_part( 'slider' ); ?>
					<div class="edgtf-full-width">
						<div class="edgtf-full-width-inner">
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
	<?php
	$audio_link     = get_post_meta( get_the_ID(), "edgtf_page_audio_custom_meta", true );
	$has_audio_link = get_post_meta( get_the_ID(), "edgtf_audio_page_meta", true ) === 'yes' && ! empty( $audio_link );
	
	if ( $has_audio_link ) { ?>
		<div class="edgtf-audio-page-player-holder edgtf-playing">
			<audio class="edgtf-page-audio" autoplay loop>
				<source src="<?php echo esc_url( $audio_link ); ?>" type="audio/mpeg">
			</audio>
			<a href="#" class="edgtf-audio-control">
				<svg class="edgtf-audio-play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="25px" viewBox="0 0 41.917 45.998" enable-background="new 0 0 41.917 45.998" xml:space="preserve">
					<g>
						<path stroke-width="3" stroke-miterlimit="10" d="M3.183,44.579 c-0.864,0.474-1.561,0.056-1.561-0.921V2.623c0-0.977,0.697-1.395,1.561-0.921l37.022,20.574c0.864,0.474,0.864,1.255,0,1.729 L3.183,44.579z"/>
					</g>
				</svg>
				<svg class="edgtf-audio-pause" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 30 25" enable-background="new 0 0 30 25" xml:space="preserve">
					<g>
						<rect x="5.5" y="1.625" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" width="6.25" height="21.875"/>
						<rect x="18.25" y="1.625" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" width="6.25" height="21.875"/>
					</g>
				</svg>
			</a>
		</div>
	<?php } ?>
</body>
</html>