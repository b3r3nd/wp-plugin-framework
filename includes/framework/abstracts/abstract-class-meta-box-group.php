<?php

namespace Main\Framework\Abstracts;

use Main\Framework\Loader;
use Main\Framework\Classes\Meta_Box_Group;

/**
 * Class Meta_Box_Group_Abstract
 *
 * @package Main\Framework\Abstracts
 */
abstract class Meta_Box_Group_Abstract {

	/**
	 * Default function to show meta boxes on edit screen, can be overwritten by child.
	 *
	 * @param $post
	 * @param $meta_box_group
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function html( $post, $meta_box_group ) {
		$loader           = Loader::get_instance();
		$meta_boxes_group = $loader->get_meta_box_group( $meta_box_group['id'] );

		foreach ( $meta_boxes_group->get_meta_boxes() as $meta_box ) {
			$meta_box->output( $post, $meta_boxes_group );
		}
	}

	/**
	 * @param $post_id
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function save( $post_id ) {
		$post            = get_post( $post_id );
		$meta_box_groups = Meta_Box_Group::get_meta_box_groups_by_post_type( $post->post_type );

		foreach ( $meta_box_groups as $meta_box_group ) {
			foreach ( $meta_box_group->get_meta_boxes() as $meta_box ) {
				$meta_box->save( $post_id, $meta_box->get_name(), $_POST[ $meta_box->get_name() ] );
			}
		}
	}
}