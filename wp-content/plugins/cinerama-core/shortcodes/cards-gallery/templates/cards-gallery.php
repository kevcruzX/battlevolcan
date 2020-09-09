<?php
	$fake_card = end( $images );
?>
<div <?php cinerama_edge_class_attribute( $holder_classes ); ?>>
	<div class="edgtf-cg-inner">
		<?php
		$i = 1;
		foreach ( $images as $image ) { ?>
			<div class="edgtf-cg-card">
				<div class="edgtf-cg-bundle-item" data-bundle-move-top="<?php echo esc_attr( $i * 300 ); ?>">
					<?php if ( $image['image_link'] !== '' ){ ?>
						<a href="<?php echo esc_url( $image['image_link'] ) ?>" target="<?php echo esc_attr( $image['image_target'] ) ?>">
					<?php } ?>
						<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
					<?php if ( $image['image_link'] !== '' ){ ?>
						</a>
					<?php }
				$i ++;
				?>
				</div>
			</div>
		<?php } ?>
	</div>
	<div class="edgtf-cg-fake-card">
		<img src="<?php echo esc_url( $fake_card['url'] ); ?>" alt="<?php echo esc_attr( $fake_card['alt'] ); ?>" />
	</div>
</div>