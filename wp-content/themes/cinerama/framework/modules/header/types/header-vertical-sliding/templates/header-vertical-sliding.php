<?php do_action('cinerama_edge_action_before_page_header'); ?>
<aside class="edgtf-vertical-menu-area <?php echo esc_attr($holder_class); ?>">
    <div class="edgtf-vertical-menu-area-inner">
        <div class="edgtf-vertical-area-background"></div>
        <div class="edgtf-vertical-menu-nav-holder-outer">
            <div class="edgtf-vertical-menu-nav-holder">
                <div class="edgtf-vertical-menu-holder-nav-inner">
                    <?php cinerama_edge_get_header_vertical_sliding_main_menu(); ?>
                </div>
            </div>
        </div>
        <?php if(!$hide_logo) {
            cinerama_edge_get_logo();
        } ?>
        <div class="edgtf-vertical-menu-holder">
            <div class="edgtf-vertical-menu-table">
                <div class="edgtf-vertical-menu-table-cell">
                    <div class="edgtf-vertical-menu-opener">
                        <a href="#" <?php cinerama_edge_class_attribute( $vertical_sliding_icon_class ); ?>>
                            <span class="edgtf-vertical-sliding-close-icon">
								<?php echo cinerama_edge_get_icon_sources_html( 'vertical_sliding', true ); ?>
                            </span>
                            <span class="edgtf-vertical-sliding-opener-icon">
								<?php echo cinerama_edge_get_icon_sources_html( 'vertical_sliding' ); ?>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>

<?php do_action('cinerama_edge_action_after_page_header'); ?>
