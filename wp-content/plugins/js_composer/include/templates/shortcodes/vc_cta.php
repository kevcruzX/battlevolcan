<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * @var $content - shortcode content
 * Shortcode class
 * @var WPBakeryShortCode_Vc_Cta $this
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->buildTemplate( $atts, $content );
$containerClass = trim( 'vc_cta3-container ' . esc_attr( implode( ' ', $this->getTemplateVariable( 'container-class' ) ) ) );
$cssClass = trim( 'vc_general ' . esc_attr( implode( ' ', $this->getTemplateVariable( 'css-class' ) ) ) );
?>
<section class="<?php echo esc_attr( $containerClass ); ?>"<?php echo ! empty( $atts['el_id'] ) ? ' id="' . esc_attr( $atts['el_id'] ) . '"' : false; ?>>
	<div class="<?php echo esc_attr( $cssClass ); ?>"
		<?php
		if ( $this->getTemplateVariable( 'inline-css' ) ) {
			echo ' style="' . esc_attr( implode( ' ', $this->getTemplateVariable( 'inline-css' ) ) ) . '"';
		}
		?>
	>
		<?php
		// @codingStandardsIgnoreLine
		echo $this->getTemplateVariable( 'icons-top' );
		// @codingStandardsIgnoreLine
		echo $this->getTemplateVariable( 'icons-left' );
		?>
		<div class="vc_cta3_content-container">
			<?php
			// @codingStandardsIgnoreLine
			echo $this->getTemplateVariable( 'actions-top' );
			// @codingStandardsIgnoreLine
			echo $this->getTemplateVariable( 'actions-left' );
			?>
			<div class="vc_cta3-content">
				<header class="vc_cta3-content-header">
					<?php
					// @codingStandardsIgnoreLine
					echo $this->getTemplateVariable( 'heading1' );
					// @codingStandardsIgnoreLine
					echo $this->getTemplateVariable( 'heading2' );
					?>
				</header>
				<?php
				// @codingStandardsIgnoreLine
				echo $this->getTemplateVariable( 'content' );
				?>
			</div>
			<?php
			// @codingStandardsIgnoreLine
			echo $this->getTemplateVariable( 'actions-bottom' );
			// @codingStandardsIgnoreLine
			echo $this->getTemplateVariable( 'actions-right' );
			?>
		</div>
		<?php
		// @codingStandardsIgnoreLine
		echo $this->getTemplateVariable( 'icons-bottom' );
		// @codingStandardsIgnoreLine
		echo $this->getTemplateVariable( 'icons-right' );
		?>
	</div>
</section>

