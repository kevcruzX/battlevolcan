<?php
if($show_header_top) {
	do_action('cinerama_edge_action_before_header_top');
	?>
	
	<?php if($show_header_top_background_div){ ?>
		<div class="edgtf-top-bar-background"></div>
	<?php } ?>
	
	<div class="edgtf-top-bar">
		<?php do_action( 'cinerama_edge_action_after_header_top_html_open' ); ?>
		
		<?php if($top_bar_in_grid) : ?>
			<div class="edgtf-grid">
		<?php endif; ?>
				
			<div class="edgtf-vertical-align-containers">
				<div class="edgtf-position-left"><!--
				 --><div class="edgtf-position-left-inner">
						<?php if(is_active_sidebar('edgtf-top-bar-left')) : ?>
							<?php dynamic_sidebar('edgtf-top-bar-left'); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="edgtf-position-right"><!--
				 --><div class="edgtf-position-right-inner">
						<?php if(is_active_sidebar('edgtf-top-bar-right')) : ?>
							<?php dynamic_sidebar('edgtf-top-bar-right'); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
				
		<?php if($top_bar_in_grid) : ?>
			</div>
		<?php endif; ?>
		
		<?php do_action( 'cinerama_edge_action_before_header_top_html_close' ); ?>
	</div>
	
	<?php do_action('cinerama_edge_action_after_header_top');
}