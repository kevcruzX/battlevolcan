<div class="edgtf-fullscreen-with-sidebar-search-holder">
	<a <?php cinerama_edge_class_attribute( $search_close_icon_class ); ?> href="javascript:void(0)">
		<?php echo cinerama_edge_get_icon_sources_html( 'search', true, array( 'search' => 'yes' ) ); ?>
	</a>
	<div class="edgtf-fullscreen-search-table">
		<div class="edgtf-fullscreen-search-cell">
            <div class="edgtf-fullscreen-search-inner <?php echo esc_attr($search_in_grid); ?>">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="edgtf-fullscreen-search-form" method="get">
					<div class="edgtf-form-holder">
						<div class="edgtf-form-holder-inner">
							<div class="edgtf-field-holder">
								<input type="text" placeholder="<?php esc_attr_e( 'Search...', 'cinerama' ); ?>" name="s" class="edgtf-search-field" autocomplete="off"/>
							</div>
							<button type="submit" <?php cinerama_edge_class_attribute( $search_submit_icon_class ); ?>>
								<?php echo cinerama_edge_get_icon_sources_html( 'search', false, array( 'search' => 'yes' ) ); ?>
							</button>
						</div>
					</div>
				</form>
                <div class="edgtf-fullscreen-sidebar">
                    <?php cinerama_edge_get_fullscreen_sidebar(); ?>
                </div>
			</div>
		</div>
	</div>
</div>