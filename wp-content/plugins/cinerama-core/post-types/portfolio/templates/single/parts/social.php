<?php if ( cinerama_edge_core_plugin_installed() && cinerama_edge_options()->getOptionValue( 'enable_social_share' ) == 'yes' && cinerama_edge_options()->getOptionValue( 'enable_social_share_on_portfolio-item' ) == 'yes' ) : ?>
	<div class="edgtf-ps-info-item edgtf-ps-social-share">
		<?php
		/**
		 * Available params type, icon_type and title
		 *
		 * Return social share html
		 */
		echo cinerama_edge_get_social_share_html( array( 'type'  => 'list', 'title' => esc_attr__( 'Share:', 'cinerama-core' ) ) ); ?>
	</div>
<?php endif; ?>