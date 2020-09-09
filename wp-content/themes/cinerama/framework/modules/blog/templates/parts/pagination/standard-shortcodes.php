<?php if($max_num_pages > 1) { ?>
    <div class="edgtf-blog-pag-loading">
        <div class="edgtf-blog-pag-bounce1"></div>
        <div class="edgtf-blog-pag-bounce2"></div>
        <div class="edgtf-blog-pag-bounce3"></div>
    </div>
	<?php
	$number_of_pages = $max_num_pages;
	$current_page = $paged;

	if ($number_of_pages > 1) { ?>
        <div class="edgtf-bl-standard-pagination">
            <ul>
                <li class="edgtf-bl-pag-prev">
                    <a href="#" data-paged="1"><span class="icon-arrows-left"></span></a>
                </li>
				<?php for ($i = 1; $i <= $number_of_pages; $i++) { ?>
					<?php
					$active_class = '';
					if ($current_page == $i) {
						$active_class = 'edgtf-bl-pag-active';
					}
					?>
                    <li class="edgtf-bl-pag-number <?php echo esc_attr($active_class); ?>">
                        <a href="#" data-paged="<?php echo esc_attr($i); ?>"><?php echo esc_html($i); ?></a>
                    </li>
				<?php } ?>
                <li class="edgtf-bl-pag-next">
                    <a href="#" data-paged="2"><span class="icon-arrows-right"></span></a>
                </li>
            </ul>
        </div>
	<?php }
	$unique_id = rand(1000, 9999);
	wp_nonce_field('edgtf_blog_load_more_nonce_' . $unique_id, 'edgtf_blog_load_more_nonce_' . $unique_id);
} ?>