<?php

namespace Main\Framework\Loader;

use Main\Framework\Abstracts\Loader_Abstract;
use Main\Plugin;
use Main\Framework\Options_page;

/**
 * Class Menu_Loader
 *
 * @package Main\Framework\Loader
 */
class Menu_Loader extends Loader_Abstract {
	/**
	 * Function is called by wordpress (action).
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function register_menus() {
		if ( Plugin::ALLOWS_MAIN_MENU_PAGE ) {
			$this->register_main_menus( $this->loader->menu_pages );
		}
		if ( Plugin::ALLOWS_SUB_MENU_PAGE ) {
			$this->register_sub_menus( $this->loader->sub_menu_pages );
		}
		if ( Plugin::ALLOWS_OPTIONS_PAGE ) {
			$this->register_options_page( $this->loader->plugin_options );
		}
	}

	/**
	 * @param $menu_pages
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function register_main_menus( $menu_pages ) {
		foreach ( $menu_pages as $menu_slug => $menu_obj ) {
			add_menu_page( $menu_obj->get_page_title(), $menu_obj->get_menu_title(), $menu_obj->get_capability(), $menu_obj->get_menu_slug(), array(
				$menu_obj->get_class(),
				"menu_page"
			), $menu_obj->get_icon_url(), $menu_obj->get_position() );
		}
	}

	/**
	 * @param $sub_menu_pages
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function register_sub_menus( $sub_menu_pages ) {
		foreach ( $sub_menu_pages as $menu_slug => $menu_obj ) {
			add_submenu_page( $menu_obj->get_parent_menu_slug(), $menu_obj->get_page_title(), $menu_obj->get_menu_title(), $menu_obj->get_capability(), $menu_obj->get_menu_slug(), array(
				$menu_obj->get_class(),
				"menu_page"
			) );
		}
	}

	/**
	 * @param $plugin_options
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function register_options_page( $plugin_options ) {
		$options_page = new Options_page( $plugin_options );
		add_options_page( Plugin::OPTIONS_PAGE_TITLE, Plugin::OPTIONS_MENU_TITLE, "administrator", Plugin::OPTIONS_MENU_SLUG, array(
			$options_page,
			"menu_page"
		) );
	}
}