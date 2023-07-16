(function ($) {
  "use strict";
  var imageOrder = [];

  function updateImageData(imageOrder, updatedUrls) {
    // AJAX request to update image data
    $.ajax({
      url: ajaxurl, // WordPress AJAX handler URL
      type: "POST",
      data: {
        action: "store_image_data",
        image_order: imageOrder,
        image_urls: updatedUrls
      },
      success: function (response) {
        console.log("Image data updated successfully");
      },
      error: function (error) {
        console.log("Error updating image data");
      },
    });
  }

  /**
   * All of the code for your admin-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   */
  $(function () {
    var mediaUploader;

    $("#upload-button").on("click", function (e) {
      e.preventDefault();

      if (mediaUploader) {
        mediaUploader.open();
        return;
      }

      mediaUploader = wp.media({
        title: "Select Images",
        button: {
          text: "Use these images",
        },
        multiple: true,
      });

      mediaUploader.on("select", function () {
        var attachments = mediaUploader.state().get("selection").toJSON();
        var imageUrls = [];

        attachments.forEach(function (attachment) {
          imageUrls.push(attachment.url);
          imageOrder.push(attachment.id);
          $("#image-preview").append(
            '<li data-image-id="' +
              attachment.id +
              '"><img src="' +
              attachment.url +
              '"><button class="delete-button" data-image-id="' +
              attachment.id +
              '"> X </button></li>'
          );
        });

        $("#image-url").val(imageUrls.join(","));
        $("#image-order").val(imageOrder.join(","));
		updateImageData(imageOrder, imageUrls);
        // Initialize jQuery UI Sortable
        $("#image-preview").sortable({
			stop: function (event, ui) {
			  // Get the updated image order
			  var updatedOrder = $(this).sortable("toArray", {
				attribute: "data-image-id",
			  });
		  
			  // Update the imageOrder array with the new order
			  imageOrder = updatedOrder;
		  
			  // Update the hidden input field with the new order
			  $("#image-order").val(imageOrder.join(","));
			  // Fetch the current image URLs from the existing list
			  var existingUrls = [];
			  updatedOrder.forEach(function (imageId) {
				var $imageLi = $('[data-image-id="' + imageId + '"]');
				var imageUrl = $imageLi.find("img").attr("src");
				existingUrls.push({ id: imageId, url: imageUrl });
			  });
		  
			  // Update the imageUrls array to match the new order
			  var updatedUrls = existingUrls.map(function (url) {
				return url.url;
			  });
		  
			  console.log("Updated Image Order:", imageOrder);
			  console.log("Updated URLs:", updatedUrls);
		  
			  // Send AJAX request to update image order and URLs
			  updateImageData(imageOrder, updatedUrls);
			}
		  });  
      });

      mediaUploader.open();
    });

    $(document).on("click", ".delete-button", function () {
      var imageId = $(this).data("image-id");
      var $imageLi = $(this).closest("li");
      var imageUrl = $imageLi.find("img").attr("src");
      $('[data-image-id="' + imageId + '"]')
        .closest("li")
        .remove();

      // Remove the imageId from the imageOrder array
      imageOrder = imageOrder.filter(function (id) {
        return id !== imageId;
      });

      // Retrieve the current image URLs from the hidden input field
      var imageUrls = $("#image-url").val().split(",");
      console.log(imageUrls);
      // Remove the corresponding image URL from the imageUrls array
      imageUrls = imageUrls.filter(function (url) {
        return url !== imageUrl;
      });

      // Update the hidden input field with the new order and URLs
      $("#image-url").val(imageUrls.join(","));

      console.log("Updated Image Order:", imageOrder);
      console.log("Updated Image URLs:", imageUrls);

      // Send AJAX request to update image order and URLs
      updateImageData(imageOrder, imageUrls);
    });
  });

  /* ...and/or other possibilities.
   *
   * Ideally, it is not considered best practice to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins, and Themes may be
   * practicing this, we should strive to set a better example in our own work.
   */
})(jQuery);
