<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://github.com/akshat009/
 * @since      1.0.0
 *
 * @package    Gallery_Slider_Master
 * @subpackage Gallery_Slider_Master/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Gallery_Slider_Master
 * @subpackage Gallery_Slider_Master/admin
 * @author     Akshat Saxena <saxena.akshat.akshat@gmail.com>
 */
class Gallery_Slider_Master_Common {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Add the Shortcode .
	 *
	 * @since    1.0.0
	 */
	public function gallery_slider_shortcode() {
		ob_start();
		include_once GALLERY_SLIDER_MASTER_PATH . 'public/partials/gallery-slider-master-public-display.php';
		wp_enqueue_script( 'slick-js', GALLERY_SLIDER_MASTER_URL . 'lib/js/slick.min.js', array( 'jquery' ), $this->version, false  );
		wp_enqueue_script( $this->plugin_name, GALLERY_SLIDER_MASTER_URL . 'public/js/gallery-slider-master-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_style( $this->plugin_name, GALLERY_SLIDER_MASTER_URL . 'public/js/gallery-slider-master-public.css', '', $this->version, '' );
		wp_enqueue_style( 'slick-css', GALLERY_SLIDER_MASTER_URL . 'lib/css/slick.min.css', '', $this->version, '' );
		wp_enqueue_style( 'slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css', '', $this->version, '' );
		return ob_get_clean();
	}

}

