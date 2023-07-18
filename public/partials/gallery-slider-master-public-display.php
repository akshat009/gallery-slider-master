<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://https://github.com/akshat009/
 * @since      1.0.0
 *
 * @package    Gallery_Slider_Master
 * @subpackage Gallery_Slider_Master/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

  <?php
	$options   = get_option( 'gallery_slider_plugin_options' );
	$image_ids = isset( $options['slider_images'] ) ? $options['slider_images'] : array();
	?>
<!-- HTML -->
<div class="container">
<h2><b>Slider</b></h2>
<hr>
<section class="slider">
<?php foreach ( $image_ids as $image_id ) : ?>
				<?php $image_url = wp_get_attachment_image_url( $image_id, 'full' ); ?>
				<?php if ( $image_url ) : ?>
					<div class="slide">
						<img src="<?php echo esc_url( $image_url ); ?>" alt="Slider Image" />
					</div>
					<?php endif; ?>
					<?php endforeach; ?>
	</section>
<hr>
</div>
<!-- HTML-END -->


