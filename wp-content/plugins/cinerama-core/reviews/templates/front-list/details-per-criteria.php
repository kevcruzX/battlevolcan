<?php if(is_array($post_ratings) && count($post_ratings)) { ?>
    <?php $average_rating_total = cinerama_core_get_total_average_rating($post_ratings); ?>
    <div class="edgtf-reviews-list-info edgtf-reviews-per-criteria">
        <div class="edgtf-item-reviews-display-wrapper clearfix">
            <?php if(!empty($title)) { ?>
                <h3 class="edgtf-item-review-title"><?php echo esc_html($title); ?></h3>
            <?php } ?>

            <?php if(!empty($subtitle)) { ?>
                <p class="edgtf-item-review-subtitle"><?php echo esc_html($subtitle); ?></p>
            <?php } ?>

            <div class="edgtf-grid-row">
                <div class="edgtf-grid-col-3">
                    <div class="edgtf-item-reviews-average-wrapper">
                        <div class="edgtf-item-reviews-average-rating">
                            <?php echo esc_html(cinerama_core_reviews_format_rating_output($average_rating_total)); ?>
                        </div>
                        <div class="edgtf-item-reviews-verbal-description">
                            <span class="edgtf-item-reviews-rating-icon">
                                <?php echo cinerama_core_reviews_get_icon_for_rating($average_rating_total); ?>
                            </span>
                            <span class="edgtf-item-reviews-rating-description">
                                <?php echo esc_html(cinerama_core_reviews_get_description_for_rating($average_rating_total)); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="edgtf-grid-col-9">
                    <div class="edgtf-rating-percentage-wrapper">
                        <?php
                        foreach($post_ratings as $rating) {
                            $percentage = cinerama_core_post_average_rating_per_criteria($rating);
                            echo do_shortcode( '[edgtf_progress_bar percent="' . esc_attr( $percentage ) . '" title="' . esc_attr( $rating['label'] ) . '"]' );
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }