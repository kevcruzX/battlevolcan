<article class="edgtf-pl-item edgtf-item-space <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?>">
	<div class="edgtf-pl-item-inner">
		<?php echo cinerama_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'layout-collections/' . $item_style, '', $params ); ?>

		<a itemprop="url" class="edgtf-pli-link edgtf-block-drag-link" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>"></a>
	</div>
</article>