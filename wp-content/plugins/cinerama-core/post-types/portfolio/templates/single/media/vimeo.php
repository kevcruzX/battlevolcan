<?php if($lightbox) : ?>
    <a itemprop="image" title="<?php echo esc_attr($video_title); ?>" href="<?php echo esc_url('https://vimeo.com/'.$media['video_id']); ?>" data-rel="prettyPhoto[single_pretty_photo]" class="edgtf-portfolio-video-lightbox">
        <img itemprop="image" width="100%" src="<?php echo esc_url($lightbox_thumb); ?>" alt="<?php echo esc_attr($video_title); ?>"/>
    </a>
<?php else:  ?>
    <div class="edgtf-iframe-video-holder">
        <iframe class="edgtf-iframe-video" src="<?php echo esc_url($media['video_url']); ?>" width="800" height="600" allowfullscreen></iframe>
    </div>
<?php endif; ?>
