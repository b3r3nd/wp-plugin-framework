<?php

namespace Main\Framework\Classes\Inputs;


use Main\Framework\Abstracts\Meta_Box_Options;

/**
 * Class Checkbox_Input
 *
 * @package Main\Framework\Classes\Inputs
 */
class Meta_Box_Checkbox extends Meta_Box_Options {

	/**
	 * @param $post
	 * @param $meta_boxes_group
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	function output( $post, $meta_boxes_group ) {
		if ( $meta_boxes_group->shows_labels() ) {
			echo $this->get_label() . "<br>";
		}

		$current_values = $this->get_value( $post->ID, false );

		foreach ( $this->get_options() as $option ) {
			$checked = '';
			if ( in_array( $option, $current_values ) ) {
				$checked = 'checked';
			}
			echo "<input {$checked} type='checkbox' name='{$this->get_name()}[]' value='{$option}' /> {$option} <br>";
		}
	}

	/**
	 * @param $post_id
	 * @param $key
	 * @param $values
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function save( $post_id, $key, $values ) {
		delete_post_meta( $post_id, $key );

		if ( is_array( $values ) ) {
			foreach ( $values as $value ) {
				add_post_meta( $post_id, $key, $value, false );
			}
		} else {
			add_post_meta( $post_id, $key, $values, false );
		}
	}
}