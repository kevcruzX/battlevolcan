<div class="edgtf-reviews-list-info edgtf-reviews-simple">
    <div class="edgtf-reviews-number-wrapper">
        <h4 class="edgtf-reviews-summary">
            <span class="edgtf-reviews-number">
                <?php echo esc_html($rating_number); ?>
            </span>
            <span class="edgtf-reviews-label">
                <?php echo esc_html($rating_label); ?>
            </span>
        </h4>
        <span class="edgtf-stars-wrapper">
            <?php foreach($post_ratings as $rating) { ?>
                <span class="edgtf-stars-wrapper-inner">
                    <span class="edgtf-stars-items">
                        <?php
                        $review_rating = cinerama_core_post_average_rating($rating);
                        for ($i = 1; $i <= $review_rating; $i++) { ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        <?php } ?>
                    </span>
                    <span class="edgtf-stars-label">
                        <?php echo esc_html($rating['label']); ?>
                    </span>
                </span>
            <?php } ?>
        </span>
    </div>
</div>