<?php

namespace Main\Custom\Custom_Post_Types;

use Main\Framework\Custom_Post_Interface;

/**
 * Class Test
 *
 * @package Main\Custom\Custom_Post_Types
 * @author Berend de Groot <berend@nugtr.nl>
 */
class Test implements Custom_Post_Interface {

	public function __construct() {

	}

	public function save_post( $post_id, $post ) {

	}

	public function trash_post( $post_id ) {

	}

	public function untrash_post( $post_id ) {

	}

	public function before_delete_post( $post_id ) {

	}

	public function transition_post_status( $new_status, $old_status, $post ) {

	}
}