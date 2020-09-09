<div class="edgtf-footer-bottom-holder">
    <div class="edgtf-footer-bottom-inner <?php echo esc_attr($footer_bottom_grid_class); ?>">
        <div class="edgtf-grid-row <?php echo esc_attr($footer_bottom_classes); ?>">
            <?php for ($i = 0; $i < sizeof($footer_bottom_columns); $i++) { ?>
                <div class="edgtf-grid-col-<?php echo esc_attr($footer_bottom_columns[$i]); ?>">
                    <?php
                    if (is_active_sidebar('footer_bottom_column_' . ($i + 1))) {
                        dynamic_sidebar('footer_bottom_column_' . ($i + 1));
                    }
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>