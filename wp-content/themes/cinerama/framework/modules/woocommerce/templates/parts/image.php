<?php
$product = cinerama_edge_return_woocommerce_global_variable();

if ( $product->is_on_sale() ) { ?>
	<span class="edgtf-<?php echo esc_attr( $class_name ); ?>-onsale"><?php echo cinerama_edge_get_woocommerce_sale( $product ); ?></span>
<?php } ?>

<?php if ( ! $product->is_in_stock() ) { ?>
	<span class="edgtf-<?php echo esc_attr( $class_name ); ?>-out-of-stock"><?php esc_html_e( 'Sold', 'cinerama' ); ?></span>
<?php }

$new = get_post_meta( get_the_ID(), 'edgtf_show_new_sign_woo_meta', true );

if ( $new === 'yes' ) { ?>
	<span class="edgtf-<?php echo esc_attr( $class_name ); ?>-new-product"><?php esc_html_e( 'New', 'cinerama' ); ?></span>
<?php }

$product_image_size = 'woocommerce_single';
if ( $image_size === 'full' ) {
	$product_image_size = 'full';
} else if ( $image_size === 'square' ) {
	$product_image_size = 'cinerama_edge_image_square';
} else if ( $image_size === 'landscape' ) {
	$product_image_size = 'cinerama_edge_image_landscape';
} else if ( $image_size === 'portrait' ) {
	$product_image_size = 'cinerama_edge_image_portrait';
} else if ( $image_size === 'medium' ) {
	$product_image_size = 'medium';
} else if ( $image_size === 'large' ) {
	$product_image_size = 'large';
} else if ( $image_size === 'woocommerce_thumbnail' ) {
	$product_image_size = 'woocommerce_thumbnail';
}

if ( has_post_thumbnail() ) {
	the_post_thumbnail( apply_filters( 'cinerama_edge_filter_product_list_image_size', $product_image_size ) );
}