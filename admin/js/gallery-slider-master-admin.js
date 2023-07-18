(function ($) {
  $(function () {
  "use strict";
  var frame;
  var imageContainer = $("#image-preview");
  $("#upload-button").on("click", function (e) {
    e.preventDefault(); // If the media frame already exists, reopen it.
    if (frame) {
      frame.open();
      return;
    }
    // Create a new media frame
    frame = wp.media({
      title: "Select Images",
      button: {
        text: "Use Selected Images",
      },
      multiple: true,
    });
    frame.on("select", function () {
      var attachments = frame.state().get("selection").toArray();
      var imageIds = [];
      attachments.forEach(function (attachment) {
        var imageUrl = attachment.attributes.url;
        var imageId = attachment.id;
        imageIds.push(imageId);
        // Create the HTML markup for the image preview
        var imagePreview = $(
          '<div class="image-preview"><img src="' +
            imageUrl +
            '" alt="Slider Image" /></div>'
        );
        var hiddenInput = $(
          '<input type="hidden" name="gallery_slider_plugin_options[slider_images][]" value="' +
            imageId +
            '">'
        );
        // Append the image preview and hidden input to the container
        imagePreview.append(hiddenInput);
        imageContainer.append(imagePreview);
      });
    });
    // Open the media frame
    frame.open();
  });
  $("#image-preview").sortable();
  // Delete button click handler
  $(".delete-button").on("click", function (e) {
    e.preventDefault();
    //var imageId = $(this).data("image-id");
    $(this).closest(".image-preview").remove();
    //removeFromImageOrder(imageId);
  });
});
})(jQuery);
