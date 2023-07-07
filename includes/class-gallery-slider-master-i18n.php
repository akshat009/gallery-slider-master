<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://github.com/akshat009/
 * @since      1.0.0
 *
 * @package    Gallery_Slider_Master
 * @subpackage Gallery_Slider_Master/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Gallery_Slider_Master
 * @subpackage Gallery_Slider_Master/includes
 * @author     Akshat Saxena <saxena.akshat.akshat@gmail.com>
 */
class Gallery_Slider_Master_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'gallery-slider-master',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
