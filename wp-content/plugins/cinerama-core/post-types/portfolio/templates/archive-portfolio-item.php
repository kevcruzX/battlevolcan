<?php
get_header();
cinerama_edge_get_title();
do_action( 'cinerama_edge_action_before_main_content' ); ?>
<div class="edgtf-container edgtf-default-page-template">
	<?php do_action( 'cinerama_edge_action_after_container_open' ); ?>
	<div class="edgtf-container-inner clearfix">
		<?php
			$cinerama_taxonomy_id   = get_queried_object_id();
			$cinerama_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$cinerama_taxonomy      = ! empty( $cinerama_taxonomy_id ) ? get_term_by( 'id', $cinerama_taxonomy_id, $cinerama_taxonomy_type ) : '';
			$cinerama_taxonomy_slug = ! empty( $cinerama_taxonomy ) ? $cinerama_taxonomy->slug : '';
			$cinerama_taxonomy_name = ! empty( $cinerama_taxonomy ) ? $cinerama_taxonomy->taxonomy : '';
			
			cinerama_core_get_archive_portfolio_list( $cinerama_taxonomy_slug, $cinerama_taxonomy_name );
		?>
	</div>
	<?php do_action( 'cinerama_edge_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
