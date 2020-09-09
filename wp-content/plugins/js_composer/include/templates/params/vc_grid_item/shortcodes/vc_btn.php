<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
// @codingStandardsIgnoreLine
echo '{{ vc_btn: ' . http_build_query( $atts ) . ' }}';
