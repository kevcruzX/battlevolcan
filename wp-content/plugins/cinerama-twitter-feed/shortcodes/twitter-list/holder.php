<div class="edgtf-twitter-list-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="edgtf-tl-wrapper edgtf-outer-space">
        <?php if ( isset($response) && $response->status ) { ?>
            <?php if ( is_array( $response->data ) && count( $response->data ) ) { ?>
                <ul class="edgtf-twitter-list">
                    <?php foreach ( $response->data as $tweet ) { ?>
                        <?php
                            $params['tweet'] = $tweet;
                            echo cinerama_twitter_get_shortcode_module_template_part('templates/item', 'twitter-list', '', $params);
                        ?>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <div class="edgtf-twitter-message">
                    <?php echo esc_html( $response->message ); ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="edgtf-twitter-not-connected">
                <?php esc_html_e( 'It seems that you haven\'t connected with your Twitter account', 'cinerama-twitter-feed' ); ?>
            </div>
        <?php } ?>
    </div>
</div>