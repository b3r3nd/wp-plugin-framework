<?php
/**
 * @Plugin Name: Plugin Framework
 * @Description: Framework for plugin development
 * @Version: 1.2.0
 * @author Berend de Groot <berend@nugtr.nl>
 * Author: Berend de Groot
 * Author URI: https://www.nugtr.nl
 *
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}
require_once( 'includes/class-plugin.php' );
require_once( 'includes/framework/abstracts/abstract-class-plugin-main.php' );
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

/**
 * @return string
 * @author Berend de Groot <berend@nugtr.nl>
 */
function plugin_dir() {
	return __DIR__;
}

/**
 * @author Berend de Groot <berend@nugtr.nl>
 */
function run_plugin() {
	$plugin = new Main\Plugin_Main( __FILE__ );
	$plugin->run();
}

run_plugin();
