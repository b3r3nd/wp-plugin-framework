<?php
/**
 * Plugin Name: Plugin Template
 * Plugin URI: http://www.plugins.comsi.nl
 * Description:
 * Version: 1.0.0
 * Author: ComSi
 * Author URI: http://www.plugins.comsi.nl
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}
require_once( 'includes/class-constants.php' );
require_once( "includes/class-plugin.php" );
function run_plugin() {
	$plugin = new \PT_Setup\Plugin(__FILE__);
	$plugin->run();
}

run_plugin();
