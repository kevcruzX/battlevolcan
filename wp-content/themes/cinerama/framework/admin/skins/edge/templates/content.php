<div class="edgtf-tabs-content">
    <div class="tab-content">
        <div class="tab-pane fade in active">
            <div class="edgtf-tab-content">
                <h2 class="edgtf-page-title"><?php echo esc_html($page->title); ?></h2>
                <form method="post" class="edgtf_ajax_form">
					<?php wp_nonce_field("edgtf_ajax_save_nonce","edgtf_ajax_save_nonce") ?>
                    <div class="edgtf-page-form">
                        <?php $page->render(); ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>