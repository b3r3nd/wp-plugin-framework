<?php
namespace PT_Setup;
/**
 * The Frontend Class handles all basic actions on the frontend, for example registering styles, or changing certain
 * items on certain pages.
 */
class Frontend {
	private $version;

	/**
	 * @param $version
	 */
	public function __construct( $version ) {
		$this->version = $version;
	}

	/**
	 * Enqueues styles used in the frontend of the website
	 *
	 * @hook wp_enqueue_styles
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( Constants::PLUGIN_SHORTNAME . "-style", plugin_dir_url( __DIR__ ) . "css/style.css", array(), $this->version, false );
		wp_enqueue_script( Constants::PLUGIN_SHORTNAME . "-script", plugin_dir_url( __DIR__ ) . "js/script.js", array(), $this->version, false );
	}
}