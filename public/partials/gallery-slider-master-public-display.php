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
<style>
	h2{
text-align:center;
padding: 20px;
text-transform: uppercase; 
}
b{ 
color: red;
}
/* Slider */
.slick-slide{
	margin:0 10px;
}
.slick-dots {
  position: absolute;
  bottom: 20px; /* Adjust the distance from the bottom as needed */
  left: 0;
  right: 0;
  text-align: center;
}

.slick-dots li {
  display: inline-block;
  margin: 0 5px; /* Adjust the spacing between dots as needed */
}

.slick-dots li button {
  font-size: 12px; /* Adjust the font size of the dots as needed */
  color: #000; /* Adjust the color of the dots as needed */
  background-color: #fff; /* Adjust the background color of the dots as needed */
  border: none;
  border-radius: 50%;
  width: 10px; /* Adjust the width of the dots as needed */
  height: 10px; /* Adjust the height of the dots as needed */
  padding: 0;
  cursor: pointer;
}

.slick-dots li.slick-active button {
  background-color: #000; /* Adjust the background color of the active dot as needed */
  color: #fff; /* Adjust the color of the active dot as needed */
}
</style>
<script>
	jQuery(document).ready(function($) {
$('.slider').slick({
	slidesToShow: 3,
slidesToScroll: 1,
autoplay: true,
autoplaySpeed: 1500,
arrows: false,
dots: true,
pauseOnHover: false,
responsive: [{
breakpoint: 768,
settings: {
slidesToShow:2
}
}, {
breakpoint: 520,
settings: {
slidesToShow: 1
}
}]
});

 var maxWidth = 0;
  var maxHeight = 0;

  $('.slider .slide img').each(function() {
	var imageWidth = $(this).width();
	var imageHeight = $(this).height();

	if (imageWidth > maxWidth) {
	  maxWidth = imageWidth;
	}

	if (imageHeight > maxHeight) {
	  maxHeight = imageHeight;
	}
  });

  // Apply the maximum dimensions to all images
  $('.slider .slide img').width(maxWidth);
  $('.slider .slide img').height(maxHeight);
});
</script>
