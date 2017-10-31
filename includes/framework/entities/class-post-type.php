<?php
/**
 * @Author: ComSi
 * @Date: 27-10-17
 * @Time: 15:24
 */

namespace Main\Framework\Entities;
class Post_Type {
	private $post_type;
	private $labels;
	private $options;
	private $capabilities;
	private $supports;

	/**
	 * Post_Type constructor.
	 *
	 * @param string $post_type
	 * @param array  $labels
	 * @param array  $options
	 * @param array  $capabilities
	 * @param array  $supports
	 */
	public function __construct( $post_type = "", $labels = array(), $options = array(), $capabilities = array(), $supports = array() ) {
		$this->post_type    = $post_type;
		$this->labels       = $labels;
		$this->capabilities = $capabilities;
		$this->supports     = $supports;
		$this->options      = $options;
	}

	/**
	 * Used to quickly get all the args for the register_post_type function.
	 * @return array
	 */
	public function get_args() {
		$args = array(
			'labels'       => $this->labels,
			'capabilities' => $this->capabilities,
			'supports'     => $this->supports,
		);

		foreach($this->options as $option=>$value) {
			$args[$option] = $value;
		}

		return $args;
	}

	/**
	 * @return mixed
	 */
	public function get_post_type() {
		return $this->post_type;
	}

	/**
	 * @param string $post_type
	 */
	public function set_post_type( $post_type = "" ) {
		$this->post_type = $post_type;
	}

	/**
	 * @return array
	 */
	public function get_labels() {
		return $this->labels;
	}

	/**
	 * @param array $labels
	 */
	public function set_labels( $labels = array() ) {
		$this->labels = $labels;
	}

	/**
	 * @param string $label
	 * @param string $value
	 */
	public function set_label( $label = "", $value = "" ) {
		$this->labels[ $label ] = $value;
	}

	/**
	 * @param string $label
	 *
	 * @return mixed
	 */
	public function get_label( $label = "" ) {
		return $this->labels[ $label ];
	}

	/**
	 * @return array
	 */
	public function get_options() {
		return $this->options;
	}

	/**
	 * @param array $options
	 */
	public function set_options( $options = array() ) {
		$this->options = $options;
	}

	/**
	 * @param string $option
	 *
	 * @return mixed
	 */
	public function get_option( $option = "" ) {
		return $this->options[ $option ];
	}

	/**
	 * @param string $option
	 * @param string $value
	 */
	public function set_option( $option = "", $value = "" ) {
		$this->options[ $option ] = $value;

	}

	/**
	 * @return array
	 */
	public function get_capabilities() {
		return $this->capabilities;
	}

	/**
	 * @param array $capabilities
	 */
	public function set_capabilities( $capabilities = array() ) {
		$this->capabilities = $capabilities;
	}

	/**
	 * @param string $capability
	 *
	 * @return mixed
	 */
	public function get_capability( $capability = "" ) {
		return $this->capabilities[ $capability ];
	}

	/**
	 * @param string $capability
	 * @param string $value
	 */
	public function set_capability( $capability = "", $value = "" ) {
		$this->capabilities[ $capability ] = $value;
	}

	/**
	 * @return array
	 */
	public function get_supports() {
		return $this->supports;
	}

	/**
	 * @param array $supports
	 */
	public function set_supports( $supports = array() ) {
		$this->supports = $supports;
	}

	/**
	 * @param string $support
	 */
	public function set_support( $support = "" ) {
		array_push( $this->supports, $support );
	}
}