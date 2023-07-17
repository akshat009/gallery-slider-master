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
<html>
  <body>
  <?php
	$options   = get_option( 'gallery_slider_plugin_options' );
	$image_ids = isset( $options['slider_images'] ) ? $options['slider_images'] : array();
	?>
<div class="your-class">
			<?php foreach ( $image_ids as $image_id ) : ?>
				<?php $image_url = wp_get_attachment_image_url( $image_id, 'full' ); ?>
				<?php if ( $image_url ) : ?>
					<div class="image-preview">
						<img src="<?php echo esc_url( $image_url ); ?>" alt="Slider Image" />
					</div>
					<?php endif; ?>
					<?php endforeach; ?>
				</div>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.your-class').slick({
			slidesToShow: 3,
   slidesToScroll: 3,
   arrows: true, 
   dots: true,
   autoplay: true,
   autoplaySpeed: 2000
		});
	});
  </script>
  </body>
</html>
