<?php do_action('cinerama_edge_action_before_top_navigation'); ?>
<nav class="edgtf-fullscreen-menu">
    <?php
    wp_nav_menu(array(
        'theme_location'  => 'vertical-navigation',
        'container'       => '',
        'container_class' => '',
        'menu_class'      => '',
        'menu_id'         => '',
        'fallback_cb'     => 'top_navigation_fallback',
        'link_before'     => '<span>',
        'link_after'      => '</span>',
        'walker'          => new CineramaEdgeClassFullscreenNavigationWalker()
    ));
    ?>
</nav>
<div class="edgtf-vertical-area-widget-holder">
    <?php cinerama_edge_get_header_vertical_sliding_widget_areas(); ?>
</div>
<?php do_action('cinerama_edge_action_after_top_navigation'); ?>