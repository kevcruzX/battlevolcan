<?php

if ( $item_type === 'gallery' ) {
	$gallery = cinerama_core_get_portfolio_single_media();
	if ( $enable_count_images === 'yes' && is_array( $gallery ) && count( $gallery ) > 0 ) {
		$counter = 0;
		if ( has_post_thumbnail() ) {
			$featured = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		}
		$switch_featured_image = $this_object->getSwitchFeaturedImage( $params );
		if ( ! empty( $featured ) ) {
			$counter ++;
			if ( $item_style == 'standard-switch-images' && ! empty( $switch_featured_image ) ) {
				$counter ++;
			}
		}
		
		$counter += count( $gallery );
		
		?>
		<div class="edgtf-gli-number-of-images-holder">
			<span><?php echo esc_attr( $counter ) . esc_html__( ' pics', 'cinerama-core' ); ?></span>
		</div>
	<?php }
}