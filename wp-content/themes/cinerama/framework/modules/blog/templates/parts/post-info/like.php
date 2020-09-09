<?php if(cinerama_edge_core_plugin_installed()) { ?>
    <div class="edgtf-blog-like">
        <?php if( function_exists('cinerama_edge_get_like') ) cinerama_edge_get_like(); ?>
    </div>
<?php } ?>