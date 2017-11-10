<?php

namespace Main\Custom;

use Main\Plugin;

class Scripts {
	private $version;
	private $plugin_base_file;

	/**
	 * @param $version
	 * @param $plugin_base_file
	 */
	public function __construct( $version, $plugin_base_file ) {
		$this->version          = $version;
		$this->plugin_base_file = $plugin_base_file;
	}

	/**
	 * Enqueues styles used in the WP_ADMIN
	 *
	 * @hook admin_enqueue_styles
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style( Plugin::SHORTNAME . "-css-admin", plugin_dir_url( $this->plugin_base_file ) . "css/admin.css", array(), $this->version, false );
		wp_enqueue_script( Plugin::SHORTNAME . "-js-admin", plugin_dir_url( $this->plugin_base_file ) . "js/admin.js", array(), $this->version, false );
	}

	/**
	 * Enqueues styles used in the frontend of the website
	 *
	 * @hook wp_enqueue_styles
	 */
	public function frontend_enqueue_scripts() {
		wp_enqueue_style( Plugin::SHORTNAME . "-style", plugin_dir_url( $this->plugin_base_file ) . "css/style.css", array(), $this->version, false );
		wp_enqueue_script( Plugin::SHORTNAME . "-script", plugin_dir_url( $this->plugin_base_file ) . "js/script.js", array(), $this->version, false );
	}
}