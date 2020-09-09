<?php
$image_proportion       = cinerama_edge_get_meta_field_intersect( 'blog_list_featured_image_proportion', cinerama_edge_get_page_id() );
$image_proportion_value = get_post_meta( get_the_ID(), 'edgtf_blog_masonry_gallery_' . $image_proportion . '_dimensions_meta', true );

if ( isset( $image_proportion_value ) && $image_proportion_value !== '' ) {
	$size           = $image_proportion_value !== '' ? $image_proportion_value : 'default';
	$post_classes[] = 'edgtf-masonry-size-' . $size;
} else {
	$size           = 'default';
	$post_classes[] = 'edgtf-masonry-size-small';
}

if ( $image_proportion == 'original' ) {
	$part_params['image_size'] = 'full';
} else {
	switch ( $size ):
		case 'default':
			$part_params['image_size'] = 'cinerama_edge_image_square';
			break;
		case 'large-width':
			$part_params['image_size'] = 'cinerama_edge_image_landscape';
			break;
		case 'large-height':
			$part_params['image_size'] = 'cinerama_edge_image_portrait';
			break;
		case 'large-width-height':
			$part_params['image_size'] = 'cinerama_edge_image_huge';
			break;
		default:
			$part_params['image_size'] = 'cinerama_edge_image_square';
			break;
	endswitch;
}

$post_classes[] = 'edgtf-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $post_classes ); ?>>
	<div class="edgtf-post-content">
		<?php cinerama_edge_get_module_template_part( 'templates/parts/media', 'blog', $post_format, $part_params ); ?>

		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<?php cinerama_edge_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
			</div>
		</div>
		<a itemprop="url" class="edgtf-blog-masonry-gallery-link" href="<?php the_permalink(); ?>"></a>
	</div>
</article>