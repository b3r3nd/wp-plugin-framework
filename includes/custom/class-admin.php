<?php

namespace Main\Custom;
use Main\Constants;
/**
 * The Admin class handles everything related to the WP_ADMIN, this will be mostly styles and admin menu's.
 */
class Admin {
	private $version;
	private $plugin_base_file;

	/**
	 * @param $version
     * @param $plugin_base_file
	 */
	public function __construct( $version, $plugin_base_file ) {
		$this->version = $version;
		$this->plugin_base_file = $plugin_base_file;
		$this->register_settings();

	}

	/**
	 * Enqueues styles used in the WP_ADMIN
	 *
	 * @hook admin_enqueue_styles
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( Constants::PLUGIN_SHORTNAME . "-css-admin", plugin_dir_url(  $this->plugin_base_file ) . "css/admin.css", array(), $this->version, false );
		wp_enqueue_script( Constants::PLUGIN_SHORTNAME . "-js-admin", plugin_dir_url(  $this->plugin_base_file ) . "js/admin.js", array(), $this->version, false );
	}

	/**
	 * Register settings available in the WP_Admin
	 *
	 * @hook plugin_init
	 */
	public function register_settings() {
		register_setting( Constants::PLUGIN_OPTIONS_GROUP, "ExampleOption" );
	}
}