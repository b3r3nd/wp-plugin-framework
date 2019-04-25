<?php

namespace Main\Framework\Abstracts;

/**
 * Class Abstract_Plugin_Main
 *
 * I try to keep the main plugin class as clean as possible with only those functions needed to register post types
 * menus etc.
 *
 * @package Main\Framework
 * @author Berend de Groot <berend@nugtr.nl>
 */
abstract class  Abstract_Plugin_Main {
	protected $version;
	protected $plugin_base_file;
	protected $required_plugins;
	protected $loader;

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