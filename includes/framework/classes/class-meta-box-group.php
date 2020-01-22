<?php

namespace Main\Framework\Classes;

use Main\Framework\Loader;

class Meta_Box_Group {
	private $meta_boxes;
	private $label;
	private $screen;
	private $context;
	private $custom_class;
	private $show_labels;

	public function __construct( $label, $post_type, $custom_class, $meta_boxes = [], $context = 'normal' ) {
		$this->meta_boxes   = $meta_boxes;
		$this->label        = $label;
		$this->screen       = $post_type->get_post_type();
		$this->context      = $context;
		$this->custom_class = $custom_class;
		$this->show_labels  = true;
	}

	/**
	 * Adds meta boxes to this group.
	 *
	 * @param $meta_boxes
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function add_meta_box( $meta_boxes ) {
		if ( is_array( $meta_boxes ) ) {
			foreach ( $meta_boxes as $meta_box ) {
				$this->meta_boxes[] = $meta_box;
			}
		} else {
			$this->meta_boxes[] = $meta_boxes;
		}
	}

	/**
	 * When we arrive at the edit or create page for posts (regardless of type), we can retrieve all meta box groups
	 * simply by the post type.
	 *
	 * @param $post_type
	 *
	 * @return array
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public static function get_meta_box_groups_by_post_type( $post_type ) {
		$meta_box_groups = [];

		foreach ( Loader::get_instance()->get_meta_box_groups() as $meta_box_group ) {
			if ( $meta_box_group->get_screen() == $post_type ) {
				$meta_box_groups[] = $meta_box_group;
			}
		}

		return $meta_box_groups;
	}

	/**
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function disable_labels() {
		$this->show_labels = false;
	}

	/**
	 * @return bool
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function shows_labels() {
		return $this->show_labels;
	}

	/**
	 * @return array
	 */
	public function get_meta_boxes() {
		return $this->meta_boxes;
	}

	/**
	 * @param array $meta_boxes
	 */
	public function set_meta_boxes( $meta_boxes ) {
		$this->meta_boxes = $meta_boxes;
	}

	/**
	 * @param $class
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function set_custom_class( $class ) {
		$this->custom_class = $class;
	}

	/**
	 * @return mixed
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function get_custom_class() {
		return $this->custom_class;
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

	/**
	 * @return mixed
	 */
	public function get_screen() {
		return $this->screen;
	}

	/**
	 * @param mixed $screen
	 */
	public function set_screen( $screen ) {
		$this->screen = $screen;
	}

	/**
	 * @return mixed
	 */
	public function get_context() {
		return $this->context;
	}

	/**
	 * @param mixed $context
	 */
	public function set_context( $context ) {
		$this->context = $context;
	}
}
