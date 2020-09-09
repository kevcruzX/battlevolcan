<?php
$month                     = get_the_time( 'm' );
$year                      = get_the_time( 'Y' );
$title                     = get_the_title();
$enable_unique_date_format = cinerama_edge_options()->getOptionValue( 'enable_unique_date_format' ) === 'yes';
$difference                = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . esc_html__( ' ago', 'cinerama' );
?>
<div itemprop="dateCreated" class="edgtf-post-info-date entry-date published updated">
	<?php if ( empty( $title ) && cinerama_edge_blog_item_has_link() ) { ?>
	<a itemprop="url" href="<?php the_permalink() ?>">
		<?php } else { ?>
		<a itemprop="url" href="<?php echo get_month_link( $year, $month ); ?>">
			<?php } ?>
			<?php if ( $enable_unique_date_format ) { ?>
				<?php echo esc_html( $difference ); ?>
			<?php } else {
				the_time( get_option( 'date_format' ) );
			} ?>
		</a>
		<meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number( cinerama_edge_get_page_id() ); ?>"/>
</div>