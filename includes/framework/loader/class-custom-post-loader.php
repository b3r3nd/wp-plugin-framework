<?php

namespace Main\Framework\Loader;

use Main\Framework\Abstracts\Loader_Abstract;
use Main\Plugin;
use Main\Framework\Post_Wrapper;

/**
 * Class Custom_Post_Loader
 *
 * @package Main\Framework\Loader
 */
class Custom_Post_Loader extends Loader_Abstract {


	/**
	 * This function registers the actions for custom post types. They refer to a wrapper class which from there
	 * will call the right function in the custom post class (if enabled).
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function register_post_wrapper() {
		$post_wrapper = new Post_Wrapper( $this->loader->post_types );
		$this->loader->add_action( "save_post", $post_wrapper, "save_post", 10, 2 );
		$this->loader->add_action( "wp_trash_post", $post_wrapper, "trash_post", 10, 1 );
		$this->loader->add_action( "before_delete_post", $post_wrapper, "before_delete_post", 10, 1 );
		$this->loader->add_action( "untrash_post", $post_wrapper, "untrash_post", 10, 1 );
		$this->loader->add_action( "transition_post_status", $post_wrapper, "transition_post_status", 10, 3 );

		if ( Plugin::ALLOWS_SINGLE_TEMPLATE_FILE ) {
			$this->loader->add_filter( "single_template", $this, "register_single_template" );
		}
		if ( Plugin::ALLOWS_ARCHIVE_TEMPLATE_FILE ) {
			$this->loader->add_filter( "archive_template", $this, "register_archive_template" );
		}
	}


	/**
	 * Function to overwrite single template files. The filter is only added when the constant is set to true.
	 * This function checks if the post type is added by the plugin and if so whether or not the single template
	 * file is set. If it is set we use it instead of the default one.
	 *
	 * @param $single_template
	 *
	 * @return mixed
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function register_single_template( $single_template ) {
		global $post;
		if ( array_key_exists( $post->post_type, $this->loader->post_types ) ) {
			$custom_post_type = $this->loader->post_types[ $post->post_type ];
			/** @var $custom_post_type \Main\Framework\Classes\Post_Type */
			if ( $custom_post_type->get_single_template() !== false ) {
				$single_template = $custom_post_type->get_single_template();
			}
		}

		return $single_template;
	}

	/**
	 * Function to overwrite archive template files. The filter is only added when the constant is set to true.
	 * This functions checks if the post type is added by the plugin and if so whether or not the archive template
	 * file is set. If it is set we use it instead of the default one.
	 *
	 * @param $archive_template
	 *
	 * @return mixed
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function register_archive_template( $archive_template ) {
		global $post;
		if ( array_key_exists( $post->post_type, $this->loader->post_types ) ) {
			$custom_post_type = $this->loader->post_types[ $post->post_type ];
			/** @var $custom_post_type \Main\Framework\Classes\Post_Type */
			if ( $custom_post_type->get_archive_template() !== false ) {
				$archive_template = $custom_post_type->get_archive_template();
			}
		}

		return $archive_template;
	}
}