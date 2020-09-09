<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="edgtf-search-cover" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="edgtf-container">
		<div class="edgtf-container-inner clearfix">
	<?php } ?>
			<div class="edgtf-form-holder-outer">
				<div class="edgtf-form-holder">
					<div class="edgtf-form-holder-inner">
						<input type="text" placeholder="<?php esc_attr_e( 'Search', 'cinerama' ); ?>" name="s" class="edgtf_search_field" autocomplete="off" />
						<a <?php cinerama_edge_class_attribute( $search_close_icon_class ); ?> href="#">
							<?php echo cinerama_edge_get_icon_sources_html( 'search', true, array( 'search' => 'yes' ) ); ?>
						</a>
					</div>
				</div>
			</div>
	<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>