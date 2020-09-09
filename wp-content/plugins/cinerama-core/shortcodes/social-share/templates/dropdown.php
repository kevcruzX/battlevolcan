<div class="edgtf-social-share-holder edgtf-dropdown">
	<a class="edgtf-social-share-dropdown-opener" href="javascript:void(0)">
        <span class="edgtf-social-share-title"><?php esc_html_e('Share this', 'cinerama-core') ?></span>
		<i class="social_share"></i>
	</a>
	<div class="edgtf-social-share-dropdown">
		<ul>
			<?php foreach ($networks as $net) {
				echo wp_kses($net, array(
					'li'   => array(
						'class' => true
					),
					'a'    => array(
						'itemprop' => true,
						'class'    => true,
						'href'     => true,
						'target'   => true,
						'onclick'  => true
					),
					'img'  => array(
						'itemprop' => true,
						'class'    => true,
						'src'      => true,
						'alt'      => true
					),
					'span' => array(
						'class' => true
					)
				));
			} ?>
		</ul>
	</div>
</div>