<?php if ( ! cinerama_edge_post_has_read_more() && ! post_password_required() ) { ?>
	<div class="edgtf-post-read-more-button">
		<?php
			$button_params = array(
				'type'         => 'simple',
				'link'         => get_the_permalink(),
				'text'         => esc_html__( 'Read More', 'cinerama' ),
				'custom_class' => 'edgtf-blog-list-button'
			);
			
			echo cinerama_edge_return_button_html( $button_params );
		?>
	</div>
<?php } ?>