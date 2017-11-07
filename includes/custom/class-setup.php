<?php

namespace Main\Custom;

use Main\Constants;

/**
 * Plugin Setup Class. Here everything related to activation and deactivation of the plugin is handled.
 *
 * @package Main\Custom
 */
class Setup {
	protected $required_plugins;

	public function __construct( $required_plugins ) {
		$this->required_plugins = $required_plugins;
	}

	/**
	 * Fires then the plugin is activated.
	 *
	 * @hook plugin_activation
	 */
	public function activate() {
		if ( ! $this->required_plugins_installed() ) {
			wp_die( __( "Please install all the required plugins", Constants::PLUGIN_LANGUAGE_DOMAIN ) );
		}
	}

	/**
	 * Fires when the plugin is deactivated.
	 *
	 * @hook plugin_deactivation
	 */
	public function deactivate() {

	}

	/**
	 * Function to validate whether or not all required plugins are installed.
	 *
	 * @return boolean
	 */
	private function required_plugins_installed() {
		foreach ( $this->required_plugins as $plugin ) {
			if ( ! is_plugin_active( $plugin ) ) {
				return false;
			}
		}

		return true;
	}
}