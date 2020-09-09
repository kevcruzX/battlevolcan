<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// @codingStandardsIgnoreLine
echo '{{ featured_image: ' . http_build_query( $atts ) . ' }}';
