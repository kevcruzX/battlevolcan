<?php if ($excerpt_length !== '0' && $excerpt_length !== '' && $enable_excerpt === 'yes') {
	$excerpt = ($excerpt_length > 0) ? substr(get_the_excerpt(), 0, intval($excerpt_length)) : get_the_excerpt();
	?>
	<p itemprop="description" class="edgtf-pli-excerpt"><?php echo wp_kses( $excerpt, array( 'br' => true ) ); ?></p>
<?php } ?>