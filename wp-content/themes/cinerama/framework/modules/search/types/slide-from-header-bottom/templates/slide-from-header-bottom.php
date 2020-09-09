<div class="edgtf-slide-from-header-bottom-holder">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="edgtf-form-holder">
			<input type="text" placeholder="<?php esc_attr_e( 'Search', 'cinerama' ); ?>" name="s" class="edgtf-search-field" autocomplete="off" />
			<button type="submit" <?php cinerama_edge_class_attribute( $search_submit_icon_class ); ?>>
				<?php echo cinerama_edge_get_icon_sources_html( 'search', false, array( 'search' => 'yes' ) ); ?>
			</button>
		</div>
	</form>
</div>