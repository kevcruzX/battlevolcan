<?php
$video_type = get_post_meta( get_the_ID(), "edgtf_video_type_meta", true );
$has_video_link = get_post_meta(get_the_ID(), "edgtf_post_video_custom_meta", true) !== '' || get_post_meta(get_the_ID(), "edgtf_post_video_link_meta", true) !== '';
?>
<?php if($has_video_link) { ?>
<div class="edgtf-blog-video-holder">
    <?php
    if ( $video_type == 'social_networks' ) {
        $videolink = get_post_meta( get_the_ID(), "edgtf_post_video_link_meta", true );
        echo wp_oembed_get( esc_url($videolink) );
    } else if ( $video_type == 'self' ) {
	    $videolink  = get_post_meta(get_the_ID(), "edgtf_post_video_custom_meta", true);
	    $videoimage = get_post_meta(get_the_ID(), "edgtf_post_video_image_meta", true);
	    $flashmedia = get_template_directory_uri() . '/assets/js/flashmediaelement.swf';
	    ?>
	    <div class="edgtf-self-hosted-video-holder">
		    <div class="edgtf-video-wrap">
			    <video class="edgtf-self-hosted-video" poster="<?php echo esc_url( $videoimage ); ?>" preload="auto">
				    <?php if ( ! empty( $videolink ) ) { ?> <source type="video/mp4" src="<?php echo esc_url( $videolink ); ?>"> <?php } ?>
				    <object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo esc_url( $flashmedia ); ?>">
					    <param name="movie" value="<?php echo esc_url( $flashmedia ); ?>"/>
					    <param name="flashvars" value="controls=true&file=<?php echo esc_url( $videolink ); ?>" />
					    <img itemprop="image" src="<?php echo esc_url( $videoimage ); ?>" width="1920" height="800" title="<?php esc_attr_e( 'No video playback capabilities', 'cinerama' ); ?>" alt="<?php esc_attr_e( 'Video Thumb', 'cinerama' ); ?>"/>
				    </object>
			    </video>
		    </div>
	    </div>
    <?php } ?>
</div>
<?php } ?>