<?php

namespace Main\Framework\Abstracts;

use Main\Plugin;

/**
 * Class Abstract_Plugin_Main
 *
 * I try to keep the main plugin class as clean as possible with only those functions needed to register post types
 * menus etc.
 *
 * @package Main\Framework
 * @author  Berend de Groot <berend@nugtr.nl>
 */
abstract class  Abstract_Plugin_Main {
	protected $version;
	protected $plugin_base_file;
	protected $required_plugins;
	protected $loader;

	/**
	 * This function load all the required dependencies not added by the default framework, if you added a new class
	 * please include it here.
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	protected function load_dependencies() {
		$this->require_all( Plugin::CUSTOM_MENUS_DIR );
		$this->require_all( Plugin::CUSTOM_POST_DIR );
		$this->require_all( Plugin::CUSTOM_SHORTCODE_DIR );
		$this->require_all( Plugin::CUSTOM_META_BOX_GROUP_DIR );
	}

	/**
	 * Function te require all files in directory for autoloading custom classes
	 *
	 * @param $directory
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	private function require_all( $directory ) {
		foreach ( glob( plugin_dir() . $directory . "/*.php" ) as $function ) {
			require_once( plugin_dir() . $directory . "/" . basename( $function ) );
		}
	}

	/**
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * @return mixed
	 */
	public function get_required_plugins() {
		return $this->required_plugins;
	}

	/**
	 * @return mixed
	 */
	public function get_plugin_base_file() {
		return $this->plugin_base_file;
	}

	/**
	 * Run the plugin.
	 */
	public function run() {
		$this->loader->run();
	}
}