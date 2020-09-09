<div class="edgtf-comment-form-rating">
    <label><?php echo esc_html($label); ?><span class="required">*</span></label>
    <span class="edgtf-comment-rating-box">
        <?php for ( $i = 1; $i <= CINERAMA_CORE_REVIEWS_MAX_RATING; $i ++ ) { ?>
            <span class="edgtf-star-rating" data-value="<?php echo esc_attr( $i ); ?>"></span>
        <?php } ?>
        <input type="hidden" name="<?php echo esc_attr($key); ?>" class="edgtf-rating" value="3">
    </span>
</div>