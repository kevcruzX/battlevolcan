<li>
    <div class="<?php echo esc_attr( $comment_class ); ?>">
        <?php if ( ! $is_pingback_comment ) { ?>
            <div class="edgtf-comment-image"> <?php echo cinerama_edge_kses_img( get_avatar( $comment, 'thumbnail' ) ); ?> </div>
        <?php } ?>
        <div class="edgtf-comment-text">
            <div class="edgtf-comment-info">
                <h5 class="edgtf-comment-name vcard">
                    <?php echo wp_kses_post( get_comment_author_link() ); ?>
                </h5>
                <div class="edgtf-review-rating">
                    <?php foreach($rating_criteria as $rating) { ?>
                        <?php if(!isset($rating['show']) || (isset($rating['show']) && $rating['show'])) { ?>
                            <span class="edgtf-rating-inner">
                                <span class="edgtf-rating-label">
                                    <?php echo esc_html($rating['label']); ?>
                                </span>
                                <span class="edgtf-rating-value">
                                    <?php
                                        $review_rating = get_comment_meta( $comment->comment_ID, $rating['key'], true );
                                        for ( $i = 1; $i <= $review_rating; $i ++ ) { ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php } ?>
                                </span>
                            </span>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <?php if ( ! $is_pingback_comment ) { ?>
                <div class="edgtf-text-holder" id="comment-<?php comment_ID(); ?>">
                    <div class="edgtf-review-title">
                        <span><?php echo esc_html( $review_title ); ?></span>
                    </div>
                    <?php comment_text(); ?>
                </div>
            <?php } ?>
        </div>
    </div>
<!-- li is closed by wordpress after comment rendering -->