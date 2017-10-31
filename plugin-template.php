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
require_once( 'includes/framework/interface-shortcode.php' );
require_once('includes/framework/interface-menu.php');
require_once( 'includes/framework/entities/class-post-type.php' );
require_once( 'includes/framework/entities/class-menu.php' );
require_once( 'includes/framework/class-loader.php' );

function run_plugin() {
	$plugin = new Main\Plugin( __FILE__ );
	$plugin->run();
}

run_plugin();
