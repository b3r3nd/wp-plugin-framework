<?php


namespace Main\Framework;
/**
 * Interface Custom_Post_Interface
 *
 * This interface needs to be implemented by manually created classes for custom post types.
 *
 * @package Main\Framework
 */
interface Custom_Post_Interface {

	public function save_post($post_id, $post);

	public function trash_post($post_id);

	public function untrash_post($post_id);

	public function before_delete_post($post_id);

	public function transition_post_status($new_status, $old_status, $post);



}