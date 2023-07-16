<div class="wrap">
	<h2 class="slider-heading"> <?php echo esc_html__( 'Gallery Slider Plugin Settings', 'gallery-slider-master' ); ?></h2>
	<form method="post" action="options.php" id="gallery-images">
		<?php
		// Output the settings fields
		settings_fields( 'gallery-slider-master-settings-group' );
		do_settings_sections( 'gallery-slider-master-settings' );
		echo '<input type="hidden" id="slider-images-order" name="gallery_slider_plugin_options[slider_images_order]">';
		echo '<div id="image-preview-container"></div>';
		submit_button();
		?>
	</form>
</div>

<script>
	jQuery(document).ready(function($) {
		var frame;
		var imageContainer = $('#image-preview-container');

		$('#upload-button').on('click', function(e) {
			e.preventDefault();

			// If the media frame already exists, reopen it.
			if (frame) {
				frame.open();
				return;
			}

			// Create a new media frame
			frame = wp.media({
				title: 'Select Images',
				button: {
					text: 'Use Selected Images'
				},
				multiple: true
			});

			// Handle image selection
			frame.on('select', function() {
				var attachments = frame.state().get('selection').toArray();
				var imageIds = [];

				imageContainer.empty();

				attachments.forEach(function(attachment) {
					var imageUrl = attachment.attributes.url;
					var imageId = attachment.id;

					imageIds.push(imageId);

					// Create the HTML markup for the image preview
					var imagePreview = $('<div class="image-preview"><img src="' + imageUrl + '" alt="Slider Image" /></div>');
					var hiddenInput = $('<input type="hidden" name="gallery_slider_plugin_options[slider_images][]" value="' + imageId + '">');

					// Append the image preview and hidden input to the container
					imagePreview.append(hiddenInput);
					imageContainer.append(imagePreview);
				});

				// Update the hidden input field with the image IDs
				$('#slider-images-order').val(imageIds.join(','));
			});

			// Open the media frame
			frame.open();
		});
		$("#image-preview").sortable();
	});
</script>
