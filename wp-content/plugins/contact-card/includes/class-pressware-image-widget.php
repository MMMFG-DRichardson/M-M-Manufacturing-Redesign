<?php
/**
 * Pressware Image Widget
 *
 * The main class for the Pressware Image Widget that provides all functionality for
 * displaying the dashboard, saving the options, and rendering the widget on the front
 * end of the website.
 *
 * @package   Contact_Card_Widget/includes
 * @author    Pressware, LLC
 * @license   GPL-2.0+
 * @link      http://shop.pressware.co/image-widget/
 * @copyright 2014 Pressware, LLC
 */

/**
 * Pressware Image Widget.
 *
 * The main class for the Pressware Image Widget that provides all functionality for
 * displaying the dashboard, saving the options, and rendering the widget on the front
 * end of the website.
 *
 * @since    1.0.0
 */
class Contact_Card_Widget extends WP_Widget {

	/**
	 * The current version of the plugin.
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     string     $version    The plugin version.
	 */
	private $version;

	/**
	 * The string used to identify the widget throughout the code (and in i18n).
	 *
	 * @since   1.0.0
	 * @access  private
	 * @var     type     $string    The unique string to identify the widget.
	 */
	private $widget_slug;

	/**
	 * Initializes the widget and its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->version = '1.1.0';
		$this->widget_slug = 'contact-card';

		parent::__construct(
			$this->get_widget_slug(),
			__( 'Contact Card', $this->get_widget_slug() ),
			array(
				'classname'   => 'contact-card-widget-class',
				'description' => __( 'Card widget with fields for name, title, phone, fax, email, and image.', $this->get_widget_slug() )
			)
		);

		$this->load_dependencies();

	}

	/**
	 * Loads the text domain for i18n of the plugin.
	 *
	 * @since    1.0.0
	 */
	public function text_domain() {

		load_plugin_textdomain(
			$this->get_widget_slug(),
			FALSE,
			dirname( plugin_basename( __FILE__ ) ) . '/languages/'
		);

	}

	/**
	 * Renders the widget on the front end of the website.
	 *
	 * @since    1.0.0
	 * @param    array    $args        The values maintained by WordPress for before/after the widget, and its description.
	 * @param    array    $instance    The values of the current instance of the widget.
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		/**
		 * Renders the public-facing view of the widget.
		 */
		include( plugin_dir_path( dirname( __FILE__ ) ) . 'public/views/widget.php' );

	}

	/**
	 * Renders the dashboard of the widget.
	 *
	 * @since    1.0.0
	 * @param    array    $instance    The array of settings for the widget.
	 */
	public function form( $instance ) {

		$id = isset( $instance['pressware-image-id'] ) ? $instance['pressware-image-id'] : '';
		$title = isset( $instance['pressware-image-title'] ) ? $instance['pressware-image-title'] : '';
		$url = isset( $instance['pressware-image-url'] ) ? $instance['pressware-image-url'] : '';
		$alt = isset( $instance['pressware-image-alt'] ) ? $instance['pressware-image-alt'] : '';
		$caption = isset( $instance['pressware-image-caption'] ) ? $instance['pressware-image-caption'] : '';
		$description = isset( $instance['pressware-image-description'] ) ? $instance['pressware-image-description'] : '';
		$width = isset( $instance['pressware-image-width'] ) ? $instance['pressware-image-width'] : '';
		$height = isset( $instance['pressware-image-height'] ) ? $instance['pressware-image-height'] : '';
		$anchor = isset( $instance['pressware-image-anchor'] ) ? $instance['pressware-image-anchor'] : '';
		
		$name = isset( $instance['contact-name'] ) ? $instance['contact-name'] : '';
		$position = isset( $instance['contact-position'] ) ? $instance['contact-position'] : '';
		$phone = isset( $instance['contact-phone'] ) ? $instance['contact-phone'] : '';
		$fax = isset( $instance['contact-fax'] ) ? $instance['contact-fax'] : '';
		$email = isset( $instance['contact-email'] ) ? $instance['contact-email'] : '';

		/**
		 * The dashboard template for the widget.
		 */
		include( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/views/form.php' );

	}

	/**
	 * Updates the current instance of the widget with settings from the dashboard.
	 *
	 * @since    1.0.0
	 * @param    array    $new_instance    The instance of new settings for the widget.
	 * @param    array    $old_instance    The instance of old settings for the widget.
	 * @return   array                     The updated version of the widget.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		
		$instance['contact-name'] = ( ! empty( $new_instance['contact-name'] ) ) ? $new_instance['contact-name'] : '';
		$instance['contact-position'] = ( ! empty( $new_instance['contact-position'] ) ) ? $new_instance['contact-position'] : '';
		$instance['contact-phone'] = ( ! empty( $new_instance['contact-phone'] ) ) ? $new_instance['contact-phone'] : '';
		$instance['contact-fax'] = ( ! empty( $new_instance['contact-fax'] ) ) ? $new_instance['contact-fax'] : '';
		$instance['contact-email'] = ( ! empty( $new_instance['contact-email'] ) ) ? $new_instance['contact-email'] : '';
		$instance['contact-image-url'] = ( ! empty( $new_instance['contact-image-url'] ) ) ? $new_instance['contact-image-url'] : '';
		
		$instance['pressware-image-id'] = ( ! empty( $new_instance['pressware-image-id'] ) ) ? $new_instance['pressware-image-id'] : '';
		$instance['pressware-image-title'] = ( ! empty( $new_instance['pressware-image-title'] ) ) ? $new_instance['pressware-image-title'] : '';
		$instance['pressware-image-url'] = ( ! empty( $new_instance['pressware-image-url'] ) ) ? $new_instance['pressware-image-url'] : '';
		$instance['pressware-image-alt'] = ( ! empty( $new_instance['pressware-image-alt'] ) ) ? $new_instance['pressware-image-alt'] : '';
		$instance['pressware-image-caption'] = ( ! empty( $new_instance['pressware-image-caption'] ) ) ? $new_instance['pressware-image-caption'] : '';
		$instance['pressware-image-description'] = ( ! empty( $new_instance['pressware-image-description'] ) ) ? $new_instance['pressware-image-description'] : '';
		$instance['pressware-image-width'] = ( ! empty( $new_instance['pressware-image-width'] ) ) ? $new_instance['pressware-image-width'] : '';
		$instance['pressware-image-height'] = ( ! empty( $new_instance['pressware-image-height'] ) ) ? $new_instance['pressware-image-height'] : '';

		$instance['pressware-image-anchor'] = ( ! empty( $new_instance['pressware-image-anchor'] ) ) ? $new_instance['pressware-image-anchor'] : '';
		$instance['pressware-image-anchor'] = $this->sanitize_url( $instance['pressware-image-anchor'] );

		return $instance;

	}

	/**
	 * Enqueues all of the scripts necessary for the plugin to run (including those for
	 * the Media Uploader).
	 *
	 * @since 1.0.0
	 */
	public function enqueue_admin_scripts() {

		wp_enqueue_media();

		wp_enqueue_script(
			$this->get_widget_slug() . '-lib',
			plugins_url( 'admin/js/pressware.image-widget.min.js', dirname( __FILE__ ) ),
			array( 'jquery' ),
			$this->get_version()
		);

		wp_enqueue_script(
			$this->get_widget_slug(),
			plugins_url( 'admin/js/admin.min.js', dirname( __FILE__ ) ),
			array( $this->get_widget_slug() . '-lib' ),
			$this->get_version()
		);

	}

	/**
	 * Enqueues all of the styles necessary to style the dashboard of the widget.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_admin_styles() {

		wp_enqueue_style(
			$this->get_widget_slug(),
			plugins_url( 'admin/css/admin.css', dirname( __FILE__ ) ),
			array(),
			$this->get_version()
		);


	}

	/**
	 * Enqueues all of the styles necessary to style the frontend of the widget.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_widget_styles() {

		wp_enqueue_style(
			$this->get_widget_slug(),
			plugins_url( 'public/css/widget.css', dirname( __FILE__ ) ),
			array(),
			$this->get_version()
		);


	}

	/**
	 * @since     1.0.0
	 * @access    private
	 * @return    string    The string used to identify the widget throughout the code (and in i18n).
	 */
	private function get_widget_slug() {
		return $this->widget_slug;
	}

	/**
	 * @since     1.0.0
	 * @access    private
	 * @return    string    The current version of the plugin.
	 */
	private function get_version() {
		return $this->version;
	}

	/**
	 * Sanitizes the URL coming in from the widget's form so that it's safe
	 * and well-formed.
	 *
	 * @since     1.1.0
	 * @access    private
	 * @param     $url        string    The incoming string which will be used as the anchor.
	 * @return    string                The URL to which the image will be linked.
	 */
	private function sanitize_url( $url ) {

		// Sanitize the incoming string
		$url = strip_tags( $url );

		// If the URL doesn't begin with a protocol, default to http
		if ( ! preg_match( "~^(?:f|ht)tps?://~i", $url ) ) {
        	$url = "http://" . $url;
		}

		$url = esc_url( trailingslashit( $url ) );

		// if, after all of this, we still don't have a valid URL, return an empty string
		return ( filter_var( $url, FILTER_VALIDATE_URL ) ) ? $url : '';

	}

	/**
	 * @since     1.1.0
	 * @access    private
	 * @return    bool        True if the image has an anchor; otherwise, false.
	 */
	private function has_image_anchor( $anchor_value ) {
		return ( 0 < strlen( trim( $anchor_value ) ) );
	}

	/**
	 * Defines all of the hooks necessary to execute the widget.
	 *
	 * @since     1.0.0
	 * @access    private
	 */
	private function load_dependencies() {

		add_action( 'init', array( $this, 'text_domain' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_widget_styles' ) );

	}

}
