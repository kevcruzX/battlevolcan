<?php
$custom_fields = get_post_meta(get_the_ID(), 'edgtf_portfolio_properties', true);

if(is_array($custom_fields) && count($custom_fields)) :
    foreach($custom_fields as $custom_field) : ?>
        <div class="edgtf-ps-info-item edgtf-ps-custom-field">
            <?php if(!empty($custom_field['item_title'])) {
	            cinerama_core_get_cpt_single_module_template_part('templates/single/parts/info-title', 'portfolio', '', array( 'title' => $custom_field['item_title'] ) );
            } ?>
	        <div class="edgtf-ps-info-value-holder">
	            <p>
	                <?php if(!empty($custom_field['item_url'])) : ?><a itemprop="url" target="_blank" href="<?php echo esc_url($custom_field['item_url']); ?>"><?php endif; ?>
	                    <?php echo esc_html($custom_field['item_text']); ?>
	                <?php if(!empty($custom_field['item_url'])) : ?></a><?php endif; ?>
	            </p>
	        </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>