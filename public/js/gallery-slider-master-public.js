(function ($) {
  "use strict";

  /**
   * All of the code for your public-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   */
  $(function () {
    $(".slider").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 1500,
      arrows: false,
      dots: true,
      pauseOnHover: false,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
          },
        },
        {
          breakpoint: 520,
          settings: {
            slidesToShow: 1,
          },
        },
      ],
    });

    var maxWidth = 0;
    var maxHeight = 0;

    $(".slider .slide img").each(function () {
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
    $(".slider .slide img").width(maxWidth);
    $(".slider .slide img").height(maxHeight);
  });
  /*
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */
})(jQuery);
