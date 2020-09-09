<?php
if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number() ) { ?>
	<div class="edgtf-comment-holder clearfix" id="comments">
		<?php if ( have_comments() ) { ?>
			<div class="edgtf-comment-holder-inner">
				<div class="edgtf-comments-title">
					<h4><?php esc_html_e( 'Comments', 'cinerama' ) . '(' . get_comments_number() . ')'; ?></h4>
				</div>
				<div class="edgtf-comments">
					<ul class="edgtf-comment-list">
						<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'cinerama_edge_comment' ), apply_filters( 'cinerama_edge_filter_comments_callback', array() ) ) ) ); ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
			<p><?php esc_html_e( 'Sorry, the comment form is closed at this time.', 'cinerama' ); ?></p>
		<?php } ?>
	</div>
	<?php
		$edgtf_commenter = wp_get_current_commenter();
		$edgtf_req       = get_option( 'require_name_email' );
		$edgtf_aria_req  = ( $edgtf_req ? " aria-required='true'" : '' );
	    $edgtf_consent  = empty( $edgtf_commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		
		$edgtf_args = array(
			'id_form'              => 'commentform',
			'id_submit'            => 'submit_comment',
			'title_reply'          => esc_html__( 'Post a Comment', 'cinerama' ),
			'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h4>',
			'title_reply_to'       => esc_html__( 'Post a Reply to %s', 'cinerama' ),
			'cancel_reply_link'    => esc_html__( 'cancel reply', 'cinerama' ),
			'label_submit'         => esc_html__( 'Send', 'cinerama' ),
			'comment_field'        => apply_filters( 'cinerama_edge_filter_comment_form_textarea_field', '<textarea id="comment" placeholder="' . esc_attr__( 'Message', 'cinerama' ) . '" name="comment" cols="45" rows="6" aria-required="true"></textarea>' ),
			'comment_notes_before' => esc_html__('Your email address will not be published. Required fields are marked *', 'cinerama' ),
			'comment_notes_after'  => '',
			'fields'               => apply_filters( 'cinerama_edge_filter_comment_form_default_fields', array(
				'author' => '<div class="edgtf-grid-row edgtf-grid-small-gutter"><div class="edgtf-grid-col-6"><input id="author" name="author" placeholder="' . esc_attr__( 'Name', 'cinerama' ) . '" type="text" value="' . esc_attr( $edgtf_commenter['comment_author'] ) . '"' . $edgtf_aria_req . ' /></div>',
				'email'  => '<div class="edgtf-grid-col-6"><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'cinerama' ) . '" type="email" value="' . esc_attr( $edgtf_commenter['comment_author_email'] ) . '"' . $edgtf_aria_req . ' /></div></div>',
				'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" ' . $edgtf_consent . ' />' .
					'<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'cinerama' ) . '</label></p>',
			) )
		);

	$edgtf_args = apply_filters( 'cinerama_edge_filter_comment_form_final_fields', $edgtf_args );
		
	if ( get_comment_pages_count() > 1 ) { ?>
		<div class="edgtf-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
	<?php } ?>

    <?php
    $edgtf_show_comment_form = apply_filters('cinerama_edge_filter_show_comment_form_filter', true);
    if($edgtf_show_comment_form) {
    ?>
        <div class="edgtf-comment-form">
            <div class="edgtf-comment-form-inner">
                <?php comment_form( $edgtf_args ); ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>	