<?php

namespace Main\Framework\Loader;

use Main\Framework\Abstracts\Loader_Abstract;

/**
 * Class Hook_loader
 *
 * @package Main\Framework\Loader
 */
class Hook_loader extends Loader_Abstract {

	/**
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function register_filters() {
		foreach ( $this->loader->filters as $hook ) {
			add_filter( $hook['hook'], array(
				$hook['component'],
				$hook['callback']
			), $hook['priority'], $hook['accepted_args'] );
		}
	}

	/**
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function register_actions() {
		foreach ( $this->loader->actions as $hook ) {
			add_action( $hook['hook'], array(
				$hook['component'],
				$hook['callback']
			), $hook['priority'], $hook['accepted_args'] );
		}
	}
}