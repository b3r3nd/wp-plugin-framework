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
require_once( 'includes/class-plugin.php' );
require_once('includes/framework/abstracts/abstract-class-plugin-main.php');
require_once( "includes/class-plugin-main.php" );
require_once( 'includes/framework/interfaces/interface-shortcode.php' );
require_once( 'includes/framework/interfaces/interface-menu.php' );
require_once( 'includes/framework/interfaces/interface-custom-post.php' );
require_once( 'includes/framework/classes/class-post-type.php' );
require_once( 'includes/framework/classes/class-menu.php' );
require_once( 'includes/framework/classes/class-option.php' );
require_once( 'includes/framework/classes/class-taxonomy.php' );
require_once( 'includes/framework/class-loader.php' );
require_once( 'includes/framework/class-options-page.php' );
require_once( 'includes/framework/class-post-wrapper.php' );
require_once( 'includes/custom/class-setup.php' );
require_once( 'includes/custom/class-scripts.php' );

function plugin_dir() {
	return __DIR__;
}

function run_plugin() {
	$plugin = new Main\Plugin_Main( __FILE__ );
	$plugin->run();
}

run_plugin();
