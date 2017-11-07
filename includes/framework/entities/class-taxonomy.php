<?php

namespace Main\Framework\Entities;
/**
 * Class Taxonomy
 *
 * @package Main\Framework\Entities
 */
class Taxonomy {
	private $taxonomy;
	private $post_type;
	private $args;

	/**
	 * Taxonomy constructor.
	 *
	 * @param $taxonomy
	 * @param $post_type
	 * @param $args
	 */
	public function __construct( $taxonomy, $post_type, $args = array() ) {
		$this->taxonomy  = $taxonomy;
		$this->post_type = $post_type;
		$this->args      = $args;
	}

	/**
	 * @return mixed
	 */
	public function getTaxonomy() {
		return $this->taxonomy;
	}

	/**
	 * @param mixed $taxonomy
	 */
	public function setTaxonomy( $taxonomy ) {
		$this->taxonomy = $taxonomy;
	}

	/**
	 * @return mixed
	 */
	public function getPostType() {
		return $this->post_type;
	}

	/**
	 * @param mixed $post_type
	 */
	public function setPostType( $post_type ) {
		$this->post_type = $post_type;
	}

	/**
	 * @return mixed
	 */
	public function getArgs() {
		return $this->args;
	}

	/**
	 * @param mixed $args
	 */
	public function setArgs( $args ) {
		$this->args = $args;
	}
}