<?php
/**
 * Plugin Name: WordPress Plugin Framework
 * Plugin URI: http://www.nugtr.nl
 * Description: Framework to help with plug-in development
 * Version: 1.3.0
 * Author: Berend de Groot <berend@nugtr.nl>
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}
require_once( 'includes/class-plugin.php' );

require_once( 'includes/framework/abstracts/abstract-class-plugin-main.php' );
require_once( 'includes/framework/abstracts/abstract-class-meta-box-group.php' );
require_once( 'includes/framework/abstracts/abstract-class-meta-box.php' );
require_once( 'includes/framework/abstracts/abstract-class-meta-box-options.php' );
require_once( 'includes/framework/abstracts/abstract-class-loader.php' );

require_once( 'includes/framework/interfaces/interface-shortcode.php' );
require_once( 'includes/framework/interfaces/interface-menu.php' );
require_once( 'includes/framework/interfaces/interface-custom-post.php' );

require_once( 'includes/class-plugin-main.php' );

require_once( 'includes/framework/classes/class-post-type.php' );
require_once( 'includes/framework/classes/class-menu.php' );
require_once( 'includes/framework/classes/class-option.php' );
require_once( 'includes/framework/classes/class-taxonomy.php' );
require_once( 'includes/framework/classes/class-meta-box-group.php' );

require_once( 'includes/framework/classes/meta-boxes/class-meta-box-checkbox.php' );
require_once( 'includes/framework/classes/meta-boxes/class-meta-box-input.php' );
require_once( 'includes/framework/classes/meta-boxes/class-meta-box-radio.php' );

require_once( 'includes/framework/class-loader.php' );
require_once( 'includes/framework/class-options-page.php' );
require_once( 'includes/framework/class-post-wrapper.php' );


require_once( 'includes/framework/loader/class-custom-post-loader.php' );
require_once( 'includes/framework/loader/class-hook-loader.php' );
require_once( 'includes/framework/loader/class-options-loader.php' );
require_once( 'includes/framework/loader/class-script-setup-loader.php' );
require_once( 'includes/framework/loader/class-shortcode-loader.php' );
require_once( 'includes/framework/loader/class-menu-loader.php' );
require_once( 'includes/framework/loader/class-meta-box-loader.php' );

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
