<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
$block = $block_data[0];
$settings = $block_data[1];
$link_setting = empty( $settings[0] ) ? '' : $settings[0];

if ( 'title' === $block ) : ?>
	<h2 class="post-title">
		<?php
		// @codingStandardsIgnoreLine
		echo empty( $link_setting ) || 'no_link' !== $link_setting ? $this->getLinked( $post, $post->title, $link_setting, 'link_title' ) : $post->title;
		?>
	</h2>
<?php elseif ( 'image' === $block && ! empty( $post->thumbnail ) ) : ?>
	<div class="post-thumb">
		<?php
		// @codingStandardsIgnoreLine
		echo empty( $link_setting ) || 'no_link' !== $link_setting ? $this->getLinked( $post, $post->thumbnail, $link_setting, 'link_image' ) : $post->thumbnail;
		?>
	</div>
<?php elseif ( 'text' === $block ) : ?>
	<div class="entry-content">
		<?php
		// @codingStandardsIgnoreLine
		echo empty( $link_setting ) || 'text' === $link_setting ? $post->content : $post->excerpt;
		?>
	</div>
<?php elseif ( 'link' === $block ) : ?>
	<a href="<?php echo esc_url( $post->link ); ?>" class="vc_read_more" title="<?php printf( esc_attr__( 'Permalink to %s', 'js_composer' ), esc_attr( $post->title_attribute ) ); ?>"
		<?php
		// @codingStandardsIgnoreLine
		echo $this->link_target;
		?>
	><?php esc_html_e( 'Read more', 'js_composer' ); ?></a>
<?php endif ?>
