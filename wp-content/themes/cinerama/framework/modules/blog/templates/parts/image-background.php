<?php
$image_size         = isset( $image_size ) ? $image_size : 'full';
$image_meta         = get_post_meta( get_the_ID(), 'edgtf_blog_list_featured_image_meta', true );
$has_featured       = ! empty( $image_meta ) || has_post_thumbnail();
$blog_list_image_id = ! empty( $image_meta ) && cinerama_edge_blog_item_has_link() ? cinerama_edge_get_attachment_id_from_url( $image_meta ) : '';
$background_image   = '';

if ( ! empty( $blog_list_image_id ) ) {
	$background_image_url = wp_get_attachment_image_src( $blog_list_image_id, $image_size );
	
	if ( ! empty( $background_image_url ) ) {
		$background_image = 'background-image: url( ' . esc_url( $background_image_url[0] ) . ')';
	}
} else {
	$background_image = 'background-image: url( ' . get_the_post_thumbnail_url( get_the_ID(), $image_size ) . ')';
}
?>
<?php if ( $has_featured ) { ?>
	<div class="edgtf-post-image-background" <?php cinerama_edge_inline_style($background_image); ?>>
        <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
<?php } ?>