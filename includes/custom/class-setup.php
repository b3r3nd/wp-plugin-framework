<?php

namespace Main\Custom;

use Main\Plugin;

/**
 * Plugin Setup Class. Here everything related to activation and deactivation of the plugin is handled.
 *
 * @package Main\Custom
 * @author  Berend de Groot <berend@nugtr.nl>
 */
class Setup {
	protected $required_plugins;

	public function __construct( $required_plugins ) {
		$this->required_plugins = $required_plugins;
	}

	/**
	 * Fires then the plugin is activated.
	 *
	 * @hook   plugin_activation
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function activate() {
		if ( ! $this->required_plugins_installed() ) {
			wp_die( __( "Please install all the required plugins", Plugin::LANGUAGE_DOMAIN ) );
		}
	}

	/**
	 * Function to validate whether or not all required plugins are installed.
	 *
	 * @return boolean
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	private function required_plugins_installed() {
		foreach ( $this->required_plugins as $plugin ) {
			if ( ! is_plugin_active( $plugin ) ) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Fires when the plugin is deactivated.
	 *
	 * @hook   plugin_deactivation
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function deactivate() {

	}
}