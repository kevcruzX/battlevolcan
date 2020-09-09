<li class="edgtf-tl-item edgtf-item-space">
    <div class="edgtf-tli-inner">
        <div class="edgtf-tli-content">
            <div class="edgtf-twitter-content-top">
                <div class="edgtf-twitter-user clearfix">
                    <div class="edgtf-twitter-image">
                        <img src="<?php echo esc_url( $twitter_api->getHelper()->getTweetProfileImage( $tweet ) ); ?>" alt="<?php esc_attr_e( $twitter_api->getHelper()->getTweetProfileName( $tweet ) ); ?>"/>
                    </div>
                    <div class="edgtf-twitter-name">
                        <div class="edgtf-twitter-autor">
                            <h5>
                                <?php echo esc_html( $twitter_api->getHelper()->getTweetProfileName( $tweet ) ); ?>
                            </h5>
                        </div>
                        <div class="edgtf-twitter-profile">
                            <a href="<?php echo esc_url( $twitter_api->getHelper()->getTweetProfileURL( $tweet ) ); ?>" target="_blank" itemprop="url">
                                <?php echo esc_html( $twitter_api->getHelper()->getTweetProfileScreenName( $tweet ) ); ?>
                            </a>
                        </div>
                    </div>
                </div>
                <i class="edgtf-twitter-icon social_twitter"></i>
            </div>
            <div class="edgtf-twitter-content-bottom">
                <div class="edgtf-tweet-text">
                    <?php echo wp_kses_post( $twitter_api->getHelper()->getTweetText( $tweet ) ); ?>
                </div>
            </div>
            <a class="edgtf-twitter-link-over" href="<?php echo esc_url( $twitter_api->getHelper()->getTweetProfileURL( $tweet ) ); ?>" target="_blank" itemprop="url"></a>
        </div>
    </div>
</li>