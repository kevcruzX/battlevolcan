<?php
/*
Template Name: Full Width Template
*/
?>
<?php
$edgtf_sidebar_layout = cinerama_edge_sidebar_layout();

get_header();
cinerama_edge_get_title();
get_template_part( 'slider' );
do_action('cinerama_edge_action_before_main_content');
?>

<div class="edgtf-full-width">
    <?php do_action( 'cinerama_edge_action_after_container_open' ); ?>
	<div class="edgtf-full-width-inner">
        <?php do_action( 'cinerama_edge_action_after_container_inner_open' ); ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="edgtf-grid-row">
				<div <?php echo cinerama_edge_get_content_sidebar_class(); ?>>
					<?php
						the_content();
						do_action( 'cinerama_edge_action_page_after_content' );
					?>
				</div>
				<?php if ( $edgtf_sidebar_layout !== 'no-sidebar' ) { ?>
					<div <?php echo cinerama_edge_get_sidebar_holder_class(); ?>>
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
        <?php do_action( 'cinerama_edge_action_before_container_inner_close' ); ?>
	</div>

    <?php do_action( 'cinerama_edge_action_before_container_close' ); ?>
</div>

<?php get_footer(); ?>