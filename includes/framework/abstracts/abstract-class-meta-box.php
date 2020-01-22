<?php

namespace Main\Framework\Abstracts;
/**
 * Class Meta_Box
 *
 * @package Main\Framework\Abstracts
 */
abstract class Meta_Box {
	private $name;
	private $label;

	public function __construct( $name, $label ) {
		$this->name  = $name;
		$this->label = $label;
	}

	abstract function output( $post, $meta_boxes_group );

	abstract function save( $post, $key, $value );

	/**
	 * @param $post_id
	 *
	 * @return mixed
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function get_value( $post_id, $single = true ) {
		return get_post_meta( $post_id, $this->get_name(), $single );
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
