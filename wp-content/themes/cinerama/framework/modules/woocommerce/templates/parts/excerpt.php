<?php

if($display_excerpt === 'yes' && $excerpt_length > 0) {
	$excerpt = ($excerpt_length > 0) ? substr(get_the_excerpt(), 0, intval($excerpt_length)) : get_the_excerpt();
	?>
	
	<p itemprop="description" class="edgtf-<?php echo esc_attr($class_name); ?>-excerpt"><?php echo esc_html($excerpt); ?></p>
<?php } ?>