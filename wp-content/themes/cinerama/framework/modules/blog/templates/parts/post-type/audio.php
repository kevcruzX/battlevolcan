<?php
$audio_type = get_post_meta( get_the_ID(), "edgtf_audio_type_meta", true );
$has_audio_link = get_post_meta(get_the_ID(), "edgtf_post_audio_custom_meta", true) !== '' || get_post_meta(get_the_ID(), "edgtf_post_audio_link_meta", true) !== '';
?>
<?php if($has_audio_link) { ?>
    <div class="edgtf-blog-audio-holder">
        <?php if ( $audio_type == 'social_networks' ) {
            $audiolink = get_post_meta( get_the_ID(), "edgtf_post_audio_link_meta", true );
            echo wp_oembed_get( esc_url($audiolink) );
        } else if ( $audio_type == 'self' ) { ?>
            <audio class="edgtf-blog-audio" src="<?php echo esc_url(get_post_meta(get_the_ID(), "edgtf_post_audio_custom_meta", true)) ?>" controls="controls">
                <?php esc_html_e("Your browser don't support audio player", "cinerama"); ?>
            </audio>
        <?php } ?>
    </div>
<?php } ?>