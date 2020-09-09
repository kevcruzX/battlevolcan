<?php ?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="edgtf-search-slide-window-top" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="edgtf-grid">
	<?php } ?>
		<div class="edgtf-search-form-inner">
			<span <?php cinerama_edge_class_attribute( $search_submit_icon_class ); ?>>
	            <?php echo cinerama_edge_get_icon_sources_html( 'search', false, array( 'search' => 'yes' ) ); ?>
			</span>
			<input type="text" placeholder="<?php esc_attr_e( 'Search', 'cinerama' ); ?>" name="s" class="edgtf-swt-search-field" autocomplete="off"/>
			<a <?php cinerama_edge_class_attribute( $search_close_icon_class ); ?> href="#">
				<?php echo cinerama_edge_get_icon_sources_html( 'search', true, array( 'search' => 'yes' ) ); ?>
			</a>
		</div>
	<?php if ( $search_in_grid ) { ?>
	</div>
	<?php } ?>
</form>