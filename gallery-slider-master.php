<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/akshat009/
 * @since             1.0.0
 * @package           Gallery_Slider_Master
 *
 * @wordpress-plugin
 * Plugin Name:       Gallery Slider Master
 * Plugin URI:        https://#
 * Description:       "Gallery Slider Master is a WordPress plugin that enables you to create stunning sliders by selecting images from the WordPress gallery. Showcase your images in an interactive and customizable slideshow with ease."
 * Version:           1.0.0
 * Author:            Akshat Saxena
 * Author URI:        https://https://github.com/akshat009/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       gallery-slider-master
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GALLERY_SLIDER_MASTER_VERSION', '1.0.0' );

/**
 * Define the variable for storing the path, used for including the files
 */
define( 'GALLERY_SLIDER_MASTER_PATH', plugin_dir_path( __FILE__ ) );
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-gallery-slider-master-activator.php
 */
function activate_gallery_slider_master() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gallery-slider-master-activator.php';
	Gallery_Slider_Master_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-gallery-slider-master-deactivator.php
 */
function deactivate_gallery_slider_master() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-gallery-slider-master-deactivator.php';
	Gallery_Slider_Master_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_gallery_slider_master' );
register_deactivation_hook( __FILE__, 'deactivate_gallery_slider_master' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-gallery-slider-master.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_gallery_slider_master() {

	$plugin = new Gallery_Slider_Master();
	$plugin->run();

}
run_gallery_slider_master();
