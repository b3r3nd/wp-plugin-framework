<?php

namespace Main\Framework\Classes;
/**
 * Class Option
 *
 * @package Main\Framework\Entities
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
	 */
	public function __construct( $name, $type, $label ) {
		$this->name  = $name;
		$this->type  = $type;
		$this->label = $label;
	}

	/**
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param mixed $type
	 */
	public function setType( $type ) {
		$this->type = $type;
	}

	/**
	 * @return mixed
	 */
	public function getLabel() {
		return $this->label;
	}

	/**
	 * @param mixed $label
	 */
	public function setLabel( $label ) {
		$this->label = $label;
	}
}