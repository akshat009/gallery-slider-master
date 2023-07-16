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
class Gallery_Slider_Master_Admin {

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
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gallery_Slider_Master_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gallery_Slider_Master_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/gallery-slider-master-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gallery_Slider_Master_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gallery_Slider_Master_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_media();
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/gallery-slider-master-admin.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'ajaxurl', admin_url( 'admin-ajax.php' ) );

	}
	/**
	 * Register the Plugin Menu for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function plugin_menu() {

		/**
		 *
		 *Add Option page to WordPress menu
		 */
		add_options_page( 'Gallery Slider Plugin Settings', 'Gallery SLider Plugin', 'manage_options', 'gallery-slider-master', array( $this, 'gallery_slider_plugin_settings' ) );

	}
	/**
	 *
	 * Callback function
	 */
	public function gallery_slider_plugin_settings() {
		include_once plugin_dir_path( __FILE__ ) . 'partials/gallery-slider-master-admin-display.php';
	}
	/**
	 *
	 * Ajax Function
	 */
	public function store_image_data() {
		if ( isset( $_POST['image_order'] ) && isset( $_POST['image_urls'] ) ) {
			$imageorder = isset( $_POST['image_order'] ) ? $_POST['image_order'] : '';
			$imageurls  = isset( $_POST['image_urls'] ) ? $_POST['image_urls'] : '';
			if ( is_array( $imageorder ) ) {
				$imageorder = array_map( 'sanitize_text_field', $imageorder );
				$imageorder = json_encode( $imageorder );
			}
			if ( is_array( $imageurls ) ) {
				$imageurls = array_map( 'esc_url', $imageurls );
				$imageurls = json_encode( $imageurls );
			}
			update_option( 'image_order', $imageorder );
			update_option( 'image_urls', $imageurls );
			wp_send_json_success( 'Image data stored successfully' );
		} else {
			wp_send_json_error( 'Image data not received' );
		}
	}
	 /**
     * Register the plugin settings.
     */
    public function register_settings() {
        register_setting(
            'gallery-slider-master-settings-group',                        // Option group
            'gallery_slider_plugin_options',                               // Option name
            array($this, 'sanitize_settings')                              // Sanitization callback
        );

        add_settings_section(
            'gallery-slider-general-section',                              // Section ID
            __('', 'gallery-slider-master'),               // Section title
            '',                                                            // Callback function (optional)
            'gallery-slider-master-settings'                               // Settings page slug
        );

        add_settings_field(
            'gallery-slider-images-field',                                 // Field ID
            __('Slider Images', 'gallery-slider-master'),                  // Field label
            array($this, 'render_images_field'),                           // Callback function
            'gallery-slider-master-settings',                              // Settings page slug
            'gallery-slider-general-section'                               // Section ID
        );
    }

    /**
     * Sanitize the plugin settings.
     */
    public function sanitize_settings($input) {
        // Sanitize and validate the settings as needed
        return $input;
    }
	 /**
     * Render the images field.
     */
    public function render_images_field() {
        $options = get_option('gallery_slider_plugin_options');
        $image_ids = isset($options['slider_images']) ? $options['slider_images'] : array();

        ?>
        <div class="image-preview-container" id="image-preview">
            <?php foreach ($image_ids as $image_id) : ?>
                <?php $image_url = wp_get_attachment_image_url($image_id, 'thumbnail'); ?>
                <?php if ($image_url) : ?>
                    <div class="image-preview">
                        <img src="<?php echo esc_url($image_url); ?>" alt="Slider Image" />
                        <input type="hidden" name="gallery_slider_plugin_options[slider_images][]" value="<?php echo esc_attr($image_id); ?>" />
						<button class="delete-button" data-image-id="<?php echo esc_attr($image_id); ?>"> X </button>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <button id="upload-button" class="button">Upload Images</button>
        <?php
    }
	
}