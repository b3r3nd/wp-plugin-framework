<?php

namespace Main\Framework\Loader;

use Main\Framework\Abstracts\Loader_Abstract;
use Main\Plugin;

/**
 * Class Options_Loader
 *
 * @package Main\Framework\Loader
 */
class Options_Loader extends Loader_Abstract {

	/**
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function register_plugin_options() {
		foreach ( $this->loader->plugin_options as $plugin_setting ) {
			register_setting( Plugin::OPTIONS_GROUP, $plugin_setting->get_name() );
		}
	}
}