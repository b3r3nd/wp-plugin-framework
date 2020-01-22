<?php

namespace Main\Framework\Classes;
/**
 * Class Option
 *
 * @package Main\Framework\Entities
 * @author  Berend de Groot <berend@nugtr.nl>
 */
class Option {
	private $name;
	private $type;
	private $label;

	/**
	 * Setting constructor.
	 *
	 * @param $name
	 * @param $type
	 * @param $label
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function __construct( $name, $type, $label ) {
		$this->name  = $name;
		$this->type  = $type;
		$this->label = $label;
	}

	/**
	 * @return mixed
	 */
	public function get_name() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function set_name( $name ) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * @param mixed $type
	 */
	public function set_type( $type ) {
		$this->type = $type;
	}

	/**
	 * @return mixed
	 */
	public function get_label() {
		return $this->label;
	}

	/**
	 * @param mixed $label
	 */
	public function set_label( $label ) {
		$this->label = $label;
	}
}