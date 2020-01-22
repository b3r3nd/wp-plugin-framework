<?php

namespace Main\Framework\Loader;

use Main\Framework\Abstracts\Loader_Abstract;
use Main\Plugin;
use Main\Custom\Scripts;
use Main\Custom\Setup;

/**
 * Class Script_Setup_Loader
 *
 * @package Main\Framework\Loader
 */
class Script_Setup_Loader extends Loader_Abstract {

	/**
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function plugin_setup() {
		if ( Plugin::ALLOWS_ADMIN_SCRIPTS ) {
			$this->loader->add_action( 'admin_enqueue_scripts', new Scripts( $this->loader->plugin->get_version(), $this->loader->plugin->get_plugin_base_file() ), 'admin_enqueue_scripts' );
		}
		if ( Plugin::ALLOWS_FRONTEND_SCRIPTS ) {
			$this->loader->add_action( "wp_enqueue_scripts", new Scripts( $this->loader->plugin->get_version(), $this->loader->plugin->get_plugin_base_file() ), "frontend_enqueue_scripts" );
		}
		if ( Plugin::ALLOWS_SETUP_HOOKS ) {
			$setup = new Setup( $this->loader->plugin->get_required_plugins() );
			register_activation_hook( $this->loader->plugin->get_plugin_base_file(), array( $setup, 'activate' ) );
			register_deactivation_hook( $this->loader->plugin->get_plugin_base_file(), array( $setup, 'deactivate' ) );
		}
	}
}