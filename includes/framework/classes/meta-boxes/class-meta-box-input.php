<?php

namespace Main\Framework\Classes\Inputs;

use Main\Framework\Abstracts\Meta_Box;

/**
 * Class Text_Input
 *
 * @package Main\Framework\Classes\Inputs
 */
class Meta_Box_Input extends Meta_Box {

	/**
	 * @param $post
	 * @param $meta_boxes_group
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	function output( $post, $meta_boxes_group ) {
		if ( $meta_boxes_group->shows_labels() ) {
			echo $this->get_label();
		}
		echo "<input name='{$this->get_name()}' type='input' value='{$this->get_value($post->ID)}' /><br>";
	}

	/**
	 * @param $post_id
	 * @param $key
	 * @param $value
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function save( $post_id, $key, $value ) {
		if ( empty( $value ) ) {
			delete_post_meta( $post_id, $key );
		} else if ( ! $this->get_value( $post_id ) ) {
			add_post_meta( $post_id, $key, $value, true );
		} else {
			update_post_meta( $post_id, $key, $value );
		}
	}
}