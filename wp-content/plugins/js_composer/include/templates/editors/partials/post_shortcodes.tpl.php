<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

?>
<script type="text/javascript">
	window.vc_post_shortcodes = JSON.parse( decodeURIComponent( ("<?php echo rawurlencode( wp_json_encode( $editor->post_shortcodes ) ); ?>" + '') ) );
</script>
