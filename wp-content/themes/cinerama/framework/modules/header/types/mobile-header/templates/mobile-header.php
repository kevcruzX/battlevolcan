<?php do_action('cinerama_edge_action_before_mobile_header'); ?>

<header class="edgtf-mobile-header">
	<?php do_action('cinerama_edge_action_after_mobile_header_html_open'); ?>
	
	<div class="edgtf-mobile-header-inner">
		<div class="edgtf-mobile-header-holder">
			<div class="edgtf-grid">
				<div class="edgtf-vertical-align-containers">
					<div class="edgtf-vertical-align-containers">
						<div class="edgtf-position-left"><!--
						 --><div class="edgtf-position-left-inner">
								<?php cinerama_edge_get_mobile_logo(); ?>
							</div>
						</div>
						<?php if($show_navigation_opener) : ?>
							<div <?php cinerama_edge_class_attribute( $mobile_icon_class ); ?>>
								<a href="javascript:void(0)">
									<span class="edgtf-mobile-menu-icon">
										<?php echo cinerama_edge_get_icon_sources_html( 'mobile_icon' ); ?>
									</span>
									<?php if(!empty($mobile_menu_title)) { ?>
										<h5 class="edgtf-mobile-menu-text"><?php echo esc_attr($mobile_menu_title); ?></h5>
									<?php } ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php cinerama_edge_get_mobile_nav(); ?>
	</div>
	
	<?php do_action('cinerama_edge_action_before_mobile_header_html_close'); ?>
</header>

<?php do_action('cinerama_edge_action_after_mobile_header'); ?>