<?php

namespace Main\Framework\Classes\Inputs;

use Main\Framework\Abstracts\Meta_Box_Options;

/**
 * Class Radio_Input
 *
 * @package Main\Framework\Classes\Inputs
 */
class Meta_Box_Radio extends Meta_Box_Options {

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
		foreach ( $this->get_options() as $option ) {
			$checked = '';
			if ( $this->get_value( $post->ID, true ) == $option ) {
				$checked = 'checked';
			}
			echo "<input {$checked} type='radio' name='{$this->get_name()}' value='{$option}' /> {$option} <br>";
		}
	}

	/**
	 * @param $post_id
	 * @param $key
	 * @param $value
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function save( $post_id, $key, $value ) {
		delete_post_meta( $post_id, $key );
		add_post_meta( $post_id, $key, $value, true );
	}
}