<?php
    $share_type = isset( $share_type ) ? $share_type : 'list';
?>

<?php if ( cinerama_edge_core_plugin_installed() && cinerama_edge_options()->getOptionValue( 'enable_social_share' ) === 'yes' && cinerama_edge_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) { ?>
    <div class="edgtf-blog-share">
		<?php echo cinerama_edge_get_social_share_html( array( 'type' => $share_type ) ); ?>
    </div>
<?php } ?>