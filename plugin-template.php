<?php
/**
 * Plugin Name: Plugin Template
 * Plugin URI: http://www.plugins.comsi.nl
 * Description:
 * Version: 1.0.0
 * Author: ComSi
 * Author URI: http://www.plugins.comsi.nl
 *
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}
require_once( 'includes/class-constants.php' );
require_once( "includes/class-plugin.php" );
require_once( 'includes/framework/interfaces/interface-shortcode.php' );
require_once( 'includes/framework/interfaces/interface-menu.php' );
require_once('includes/framework/interfaces/interface-custom-post.php');
require_once( 'includes/framework/entities/class-post-type.php' );
require_once( 'includes/framework/entities/class-menu.php' );
require_once( 'includes/framework/entities/class-option.php' );
require_once( 'includes/framework/entities/class-taxonomy.php' );
require_once( 'includes/framework/class-loader.php' );
require_once( 'includes/framework/class-options-page.php' );
require_once('includes/framework/class-post-wrapper.php');
function plugin_dir() {
	return __DIR__;
}

function run_plugin() {
	$plugin = new Main\Plugin( __FILE__ );
	$plugin->run();
}

run_plugin();

/**
 * @TODO Interface for custom post type
 * @TODO Menu page with server and plugin info.
 * @TODO Menu page with overview of user roles an capabilities
 * @TODO Good way to add new user roles and capabilities
 * @TODO Good way to modify user capabilities
 * @TODO Maybe already split up the Plugin class in multiple small setup classes?
 * @TODO Review Loader class.
 * @TODO Remove examples and add them to the documentation instead.
 * @TODO Update README.md
 *
 */
