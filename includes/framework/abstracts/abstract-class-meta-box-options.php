<?php

namespace Main\Framework\Abstracts;

/**
 * Class Meta_Box_Options
 *
 * @package Main\Framework\Abstracts
 */
abstract class Meta_Box_Options extends Meta_Box {
	private $options;

	/**
	 * @return mixed
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function get_options() {
		return $this->options;
	}

	/**
	 * @param $options
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function set_options( $options ) {
		$this->options = $options;
	}

	/**
	 * @param $option
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function add_option( $option ) {
		$this->options[] = $option;
	}

}
