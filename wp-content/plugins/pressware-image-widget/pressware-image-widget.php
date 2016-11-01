<?php
/**
 * Pressware Image Widget
 *
 * A widget that allows you to use the Media Uploader to add images to your sidebar(s).
 *
 * @package   Pressware_Image_Widget
 * @author    Pressware, LLC
 * @license   GPL-2.0+
 * @link      http://shop.pressware.co/image-widget/
 * @copyright 2014 - 2015 Pressware, LLC
 *
 * @wordpress-plugin
 * Plugin Name:       Pressware Image Widget
 * Plugin URI:        http://shop.pressware.co/image-widget/
 * Description:       A widget that allows you to use the Media Uploader to add images to your sidebar(s).
 * Version:           1.3.0
 * Author:            Pressware, LLC
 * Author URI:        http://pressware.co/
 * Text Domain:       pressware-image-widget
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly or the plugin already exists, abort.
if ( ! defined( 'WPINC' ) || class_exists( 'Pressware_Image_Widget' ) ) {
	die;
}

/**
 * The base class used to define the widget functionality of the plugin.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-pressware-image-widget.php';

/**
 * Hooks into the widget_init action and instantiates the wiget within the WordPress
 * dashboard.
 *
 * @since    1.0.0
 */
function pressware_run_image_widget() {
	add_action( 'widgets_init', create_function( '', 'register_widget( "Pressware_Image_Widget" );' ) );
}
pressware_run_image_widget();
