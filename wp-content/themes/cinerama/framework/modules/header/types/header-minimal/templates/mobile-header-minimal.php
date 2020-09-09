<?php do_action('cinerama_edge_action_before_mobile_header'); ?>

<header class="edgtf-mobile-header">
	<?php do_action('cinerama_edge_action_after_mobile_header_html_open'); ?>
	
	<div class="edgtf-mobile-header-inner">
		<div class="edgtf-mobile-header-holder">
			<div class="edgtf-grid">
				<div class="edgtf-vertical-align-containers">
					<div class="edgtf-position-left"><!--
					 --><div class="edgtf-position-left-inner">
							<?php cinerama_edge_get_mobile_logo(); ?>
						</div>
					</div>
					<div class="edgtf-position-right"><!--
					 --><div class="edgtf-position-right-inner">
							<a href="javascript:void(0)" <?php cinerama_edge_class_attribute( $fullscreen_menu_icon_class ); ?>>
								<span class="edgtf-fullscreen-menu-close-icon">
									<?php echo cinerama_edge_get_icon_sources_html( 'fullscreen_menu', true ); ?>
								</span>
								<span class="edgtf-fullscreen-menu-opener-icon">
                                    <?php echo cinerama_edge_get_icon_sources_html( 'fullscreen_menu' ); ?>
								</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<?php do_action('cinerama_edge_action_before_mobile_header_html_close'); ?>
</header>

<?php do_action('cinerama_edge_action_after_mobile_header'); ?>