<?php

namespace Main\Framework;

use Main\Framework\Classes\Post_Type;

/**
 * Class Post_Wrapper
 *
 * @package Main\Framework
 */
class Post_Wrapper {
	private $post_types;

	/**
	 * Post_Wrapper constructor.
	 *
	 * @param $post_types
	 */
	public function __construct( $post_types ) {
		$this->post_types = $post_types;
	}

	/**
	 * Checks whether or not the saved post is a custom post added by our plugin and if the specific post type has
	 * custom class enabled.
	 *
	 * @param $post_id
	 *
	 * @return bool
	 */
	public function custom_class_registered( $post_id ) {
		$post      = get_post( $post_id );
		$post_type = $post->post_type;
		/** @var  $current_post_type Post_Type */
		if ( array_key_exists( $post_type, $this->post_types ) ) {
			$current_post_type = $this->post_types[ $post_type ];
			if ( $current_post_type->has_custom_class() ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Receives the custom class by post_id. This function can only be used after the function custom_class_registered().
	 *
	 * @param $post_id
	 *
	 * @return mixed
	 */
	public function get_custom_class_from_post_id( $post_id ) {
		$post      = get_post( $post_id );
		$post_type = $post->post_type;
		$post_type_obj = $this->post_types[ $post_type ];

		return $post_type_obj->get_post_object();
	}

	/**
	 * Wrapper function for save post. I hardcored a check against trashing and untrashing, I dont want to trigger
	 * the save_post hook when a post is trashed or untrahsed. Since nothing in the post is changed anyway.
	 *
	 * @param $post_id
	 */
	public function save_post( $post_id, $post ) {
		$continue = true;
		if ( isset( $_GET["action"] ) ) {
			if ( $_GET["action"] == ( "trash" || "untrash" ) ) {
				$continue = false;
			}
		}
		if($continue) {
			if ( $this->custom_class_registered( $post_id ) ) {
				$custom_class = $this->get_custom_class_from_post_id( $post_id );
				$custom_class->save_post( $post_id, $post );
			}
		}
	}

	public function transition_post_status( $new_status, $old_status, $post ) {
		if ( $this->custom_class_registered( $post->ID ) ) {
			$custom_class = $this->get_custom_class_from_post_id( $post->ID );
			$custom_class->transition_post_status( $new_status, $old_status, $post );
		}

	}

	/**
	 * Wrapper function for trashing posts.
	 *
	 * @param $post_id
	 */
	public function trash_post( $post_id ) {
		if ( $this->custom_class_registered( $post_id ) ) {
			$custom_class = $this->get_custom_class_from_post_id( $post_id );
			$custom_class->trash_post( $post_id );
		}
	}

	/**
	 * Wrapper function for before delete post.
	 *
	 * @param $post_id
	 */
	public function before_delete_post( $post_id ) {
		if ( $this->custom_class_registered( $post_id ) ) {
			$custom_class = $this->get_custom_class_from_post_id( $post_id );
			$custom_class->before_delete_post( $post_id );
		}
	}

	/**
	 * Wrapper function for untrashing psots.
	 *
	 * @param $post_id
	 */
	public function untrash_post( $post_id ) {
		if ( $this->custom_class_registered( $post_id ) ) {
			$custom_class = $this->get_custom_class_from_post_id( $post_id );
			$custom_class->untrash_post( $post_id );
		}
	}
}