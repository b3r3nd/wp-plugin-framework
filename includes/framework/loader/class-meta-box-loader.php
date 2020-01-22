<?php

namespace Main\Framework\Loader;

use Main\Framework\Abstracts\Loader_Abstract;

/**
 * Class Meta_Box_Loader
 *
 * @package Main\Framework\Loader
 */
class Meta_Box_Loader extends Loader_Abstract {

	/**
	 * We add one general hook to add the meta boxes to wordpress. For each group of boxes we add another actions
	 * to save the required fields after the post is saved.
	 *
	 * The actions for saving are added before the metaboxes are added, because these need to be added to our loader
	 * before all the hooks (actions and filters) are registered. If we register the action at the same time as we add
	 * the meta boxes, it is too late.
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function register_meta_box_action() {
		$this->loader->add_action( "add_meta_boxes", $this, "register_meta_boxes", 10, 2 );

		foreach ( $this->loader->meta_box_groups as $meta_box_group ) {
			$this->loader->add_action( "save_post", $meta_box_group->get_custom_class(), "save", 100, 2 );
		}
	}

	/**
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function register_meta_boxes() {
		foreach ( $this->loader->meta_box_groups as $meta_box_group ) {
			if ( ! empty( $this->loader->meta_box_groups ) ) {
				add_meta_box( sanitize_key( $meta_box_group->get_label() ), $meta_box_group->get_label(), array(
					$meta_box_group->get_custom_class(),
					'html'
				), $meta_box_group->get_screen(), $meta_box_group->get_context() );
			}
		}
	}
}