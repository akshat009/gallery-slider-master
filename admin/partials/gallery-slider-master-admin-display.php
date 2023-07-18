<div class="wrap">
	<h2 class="slider-heading"> <?php echo esc_html__( 'Gallery Slider Plugin Settings', 'gallery-slider-master' ); ?></h2>
	<form method="post" action="options.php" id="gallery-images">
		<?php
		settings_fields( 'gallery-slider-master-settings-group' );
		do_settings_sections( 'gallery-slider-master-settings' );
		submit_button();
		?>
	</form>
</div>
