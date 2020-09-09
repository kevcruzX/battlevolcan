<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="edgtf-search-page-form" method="get">
	<h2 class="edgtf-search-title"><?php esc_html_e( 'New search:', 'cinerama' ); ?></h2>
	<div class="edgtf-form-holder">
		<div class="edgtf-column-left">
			<input type="text" name="s" class="edgtf-search-field" autocomplete="off" value="" placeholder="<?php esc_attr_e( 'Type here', 'cinerama' ); ?>"/>
		</div>
		<div class="edgtf-column-right">
			<button type="submit" class="edgtf-search-submit"><span class="icon_search"></span></button>
		</div>
	</div>
	<div class="edgtf-search-label">
		<?php esc_html_e( 'If you are not happy with the results below please do another search', 'cinerama' ); ?>
	</div>
</form>