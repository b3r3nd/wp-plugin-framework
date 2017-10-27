<?php
namespace Main\Custom;
use Main\Constants;
/**
 * The Frontend Class handles all basic actions on the frontend, for example registering styles, or changing certain
 * items on certain pages.
 */
class Frontend {
	private $version;
	private $plugin_base_file;

	/**
	 * @param $version
	 * @param $plugin_base_file
	 */
	public function __construct( $version, $plugin_base_file ) {
		$this->version = $version;
		$this->plugin_base_file = $plugin_base_file;
	}

	/**
	 * Enqueues styles used in the frontend of the website
	 *
	 * @hook wp_enqueue_styles
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( Constants::PLUGIN_SHORTNAME . "-style", plugin_dir_url( $this->plugin_base_file ) . "css/style.css", array(), $this->version, false );
		wp_enqueue_script( Constants::PLUGIN_SHORTNAME . "-script", plugin_dir_url( $this->plugin_base_file ) . "js/script.js", array(), $this->version, false );
	}
}