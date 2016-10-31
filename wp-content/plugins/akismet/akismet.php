<?php
/**
 * @package Akismet
 */
/*
Plugin Name: Akismet
<<<<<<< HEAD
Plugin URI: https://akismet.com/
Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from spam</strong>. It keeps your site protected even while you sleep. To get started: 1) Click the "Activate" link to the left of this description, 2) <a href="https://akismet.com/get/">Sign up for an Akismet plan</a> to get an API key, and 3) Go to your Akismet configuration page, and save your API key.
Version: 3.2
Author: Automattic
Author URI: https://automattic.com/wordpress-plugins/
=======
Plugin URI: http://akismet.com/
Description: Used by millions, Akismet is quite possibly the best way in the world to <strong>protect your blog from comment and trackback spam</strong>. It keeps your site protected from spam even while you sleep. To get started: 1) Click the "Activate" link to the left of this description, 2) <a href="http://akismet.com/get/">Sign up for an Akismet API key</a>, and 3) Go to your Akismet configuration page, and save your API key.
Version: 3.1.1
Author: Automattic
Author URI: http://automattic.com/wordpress-plugins/
>>>>>>> origin/master
License: GPLv2 or later
Text Domain: akismet
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
<<<<<<< HEAD

Copyright 2005-2015 Automattic, Inc.
=======
>>>>>>> origin/master
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

<<<<<<< HEAD
define( 'AKISMET_VERSION', '3.2' );
define( 'AKISMET__MINIMUM_WP_VERSION', '3.7' );
=======
define( 'AKISMET_VERSION', '3.1.1' );
define( 'AKISMET__MINIMUM_WP_VERSION', '3.2' );
define( 'AKISMET__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
>>>>>>> origin/master
define( 'AKISMET__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'AKISMET_DELETE_LIMIT', 100000 );

register_activation_hook( __FILE__, array( 'Akismet', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'Akismet', 'plugin_deactivation' ) );

require_once( AKISMET__PLUGIN_DIR . 'class.akismet.php' );
require_once( AKISMET__PLUGIN_DIR . 'class.akismet-widget.php' );

add_action( 'init', array( 'Akismet', 'init' ) );

<<<<<<< HEAD
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
=======
if ( is_admin() ) {
>>>>>>> origin/master
	require_once( AKISMET__PLUGIN_DIR . 'class.akismet-admin.php' );
	add_action( 'init', array( 'Akismet_Admin', 'init' ) );
}

//add wrapper class around deprecated akismet functions that are referenced elsewhere
require_once( AKISMET__PLUGIN_DIR . 'wrapper.php' );

<<<<<<< HEAD
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require_once( AKISMET__PLUGIN_DIR . 'class.akismet-cli.php' );
}
=======
>>>>>>> origin/master
