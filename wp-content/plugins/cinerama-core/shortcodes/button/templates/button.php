<button type="submit" <?php cinerama_edge_inline_style($button_styles); ?> <?php cinerama_edge_class_attribute($button_classes); ?> <?php echo cinerama_edge_get_inline_attrs($button_data); ?> <?php echo cinerama_edge_get_inline_attrs($button_custom_attrs); ?>>
    <span class="edgtf-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo cinerama_edge_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>