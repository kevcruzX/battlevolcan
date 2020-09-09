<?php
$author_info_box       = esc_attr( cinerama_edge_options()->getOptionValue( 'blog_author_info' ) );
$author_info_email     = esc_attr( cinerama_edge_options()->getOptionValue( 'blog_author_info_email' ) );
$author_id             = esc_attr( get_the_author_meta( 'ID' ) );
$social_networks       = cinerama_edge_core_plugin_installed() ? cinerama_edge_get_user_custom_fields() : false;
$display_author_social = cinerama_edge_options()->getOptionValue( 'blog_single_author_social' ) === 'no' ? false : true;
?>
<?php if ( $author_info_box === 'yes' && get_the_author_meta( 'description' ) !== "" ) { ?>
	<div class="edgtf-author-description">
		<div class="edgtf-author-description-inner">
			<div class="edgtf-author-description-content">
				<div class="edgtf-author-description-image">
					<a itemprop="url" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" title="<?php the_title_attribute(); ?>">
						<?php echo cinerama_edge_kses_img( get_avatar( get_the_author_meta( 'ID' ), 166 ) ); ?>
					</a>
				</div>
				<div class="edgtf-author-description-text-holder">
					<?php if ( get_the_author_meta( 'description' ) != "" ) { ?>
						<h5 class="edgtf-author-name vcard author">
							<a itemprop="url" href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>" title="<?php the_title_attribute(); ?>">
							<span class="fn">
								<?php
								if ( get_the_author_meta( 'first_name' ) != "" || get_the_author_meta( 'last_name' ) != "" ) {
									echo esc_html( get_the_author_meta( 'first_name' ) ) . " " . esc_html( get_the_author_meta( 'last_name' ) );
								} else {
									echo esc_html( get_the_author_meta( 'display_name' ) );
								}
								?>
							</span>
							</a>
						</h5>
						<div class="edgtf-author-text">
							<p itemprop="description"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>
						</div>
					<?php } ?>
					<?php if ( $author_info_email === 'yes' && is_email( get_the_author_meta( 'email' ) ) ) { ?>
						<p itemprop="email" class="edgtf-author-email"><?php echo sanitize_email( get_the_author_meta( 'email' ) ); ?></p>
					<?php } ?>
					<?php if ( $display_author_social ) { ?>
						<?php if ( is_array( $social_networks ) && count( $social_networks ) ) { ?>
							<div class="edgtf-author-social-icons clearfix">
								<?php foreach ( $social_networks as $network ) { ?>
									<a itemprop="url" href="<?php echo esc_url( $network['link'] ) ?>" target="_blank">
										<?php echo cinerama_edge_icon_collections()->renderIcon( $network['class'], 'font_elegant' ); ?>
									</a>
								<?php } ?>
							</div>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>