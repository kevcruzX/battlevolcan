<?php if($query_results->max_num_pages > 1) {
	$holder_styles = $this_object->getLoadMoreStyles($params);
	?>
	<div class="edgtf-pl-loading">
		<div class="edgtf-pl-loading-bounce1"></div>
		<div class="edgtf-pl-loading-bounce2"></div>
		<div class="edgtf-pl-loading-bounce3"></div>
	</div>
	<div class="edgtf-pl-load-more-holder">
		<div class="edgtf-pl-load-more" <?php cinerama_edge_inline_style($holder_styles); ?>>
			<?php 
				echo cinerama_edge_get_button_html(array(
					'link'            => 'javascript: void(0)',
					'type'            => 'outline',
					'hover_animation' => 'yes',
					'size'            => 'medium',
					'text'            => esc_html__('Load More', 'cinerama-core')
				));
			?>
		</div>
	</div>
<?php }