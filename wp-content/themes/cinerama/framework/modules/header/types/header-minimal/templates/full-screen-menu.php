<div class="edgtf-fullscreen-menu-holder-outer">
	<div class="edgtf-fullscreen-menu-holder">
		<div class="edgtf-fullscreen-menu-holder-inner">
			<?php if ($fullscreen_menu_in_grid) : ?>
				<div class="edgtf-container-inner">
			<?php endif; ?>
			
			<?php $classes = is_active_sidebar( 'fullscreen_menu_widget' ) ? 'edgtf-has-widget' : ''; ?>
			
			<div class="edgtf-fullscreen-menu-holder-wrapper <?php echo esc_attr( $classes ); ?>">
				<?php if(is_active_sidebar( 'fullscreen_menu_widget' ) ) : ?>
					<div class="edgtf-fullscreen-widget-holder">
						<div class="edgtf-fullscreen-widget-inner">
							<?php dynamic_sidebar('fullscreen_menu_widget'); ?>
						</div>
					</div>
				<?php endif;
				
				cinerama_edge_get_module_template_part('templates/full-screen-menu-navigation', 'header/types/header-minimal'); ?>
			</div>

			<?php if ($fullscreen_menu_in_grid) : ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>