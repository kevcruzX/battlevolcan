<?php
get_header();
cinerama_edge_get_title();
get_template_part( 'slider' );
do_action('cinerama_edge_action_before_main_content');

if ( have_posts() ) : while ( have_posts() ) : the_post();

	$edgtf_single_layout_meta = cinerama_edge_get_meta_field_intersect( 'blog_single_layout' );
	$edgtf_single_layout      = ! empty( $edgtf_single_layout_meta ) ? $edgtf_single_layout_meta : 'standard';

	//Get blog single type and load proper helper
	cinerama_edge_include_blog_helper_functions( 'singles', $edgtf_single_layout );
	
	//Action added for applying module specific filters that couldn't be applied on init
	do_action( 'cinerama_edge_action_blog_single_loaded' );
	
	//Get classes for holder and holder inner
	$edgtf_holder_params = cinerama_edge_get_holder_params_blog();
	?>
	
	<div class="<?php echo esc_attr( $edgtf_holder_params['holder'] ); ?>">
		<?php do_action( 'cinerama_edge_action_after_container_open' ); ?>
		
		<div class="<?php echo esc_attr( $edgtf_holder_params['inner'] ); ?>">
			<?php cinerama_edge_get_blog_single( $edgtf_single_layout ); ?>
		</div>
		
		<?php do_action( 'cinerama_edge_action_before_container_close' ); ?>
	</div>
<?php endwhile; endif;

get_footer(); ?>