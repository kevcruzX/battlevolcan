<?php if($max_num_pages > 1) { ?>
	<div class="edgtf-blog-pag-loading">
		<div class="edgtf-blog-pag-bounce1"></div>
		<div class="edgtf-blog-pag-bounce2"></div>
		<div class="edgtf-blog-pag-bounce3"></div>
	</div>
<?php
	$unique_id = rand( 1000, 9999 );
	wp_nonce_field( 'edgtf_blog_load_more_nonce_' . $unique_id, 'edgtf_blog_load_more_nonce_' . $unique_id );
}