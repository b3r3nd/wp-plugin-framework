<?php

namespace Main\Framework;

use Main\Framework\Entities\Menu;
use Main\Framework\Entities\Post_Type;

/**
 * Loader class, used to register all actions, filters, post types, taxonomies, shortcodes, menu pages and settings.
 */
class Loader {
	protected $actions;
	protected $filters;
	protected $post_types;
	protected $taxonomies;
	protected $shortcodes;
	protected $menu_pages;
	protected $sub_menu_pages;
	protected $plugin_settings;
	protected $admin_scripts;
	protected $frontend_scripts;
	/**
	 * @TODO Add functions for plugin settings
	 * @TODO Add functions for taxonomies
	 */

	/**
	 * Loader constructor.
	 */
	public function __construct() {
		$this->actions         = array();
		$this->filters         = array();
		$this->post_types      = array();
		$this->taxonomies      = array();
		$this->shortcodes      = array();
		$this->menu_pages      = array();
		$this->plugin_settings = array();
		$this->add_action( "init", $this, "wordpress_init" );
		$this->add_action( "admin_menu", $this, "register_menus" );
	}

	/**
	 * @param string $page_title
	 * @param string $menu_title
	 * @param string $capability
	 * @param string $menu_slug
	 * @param string $menu_object
	 * @param string $icon_url
	 * @param int    $postion
	 */
	public function add_menu( $page_title = "", $menu_title = "", $capability = "", $menu_slug = "", $menu_object, $icon_url = "", $postion = 0 ) {
		$this->menu_pages[ $menu_slug ] = new Menu( $page_title, $menu_title, $capability, $menu_slug, $menu_object, $icon_url, $postion, false );
	}

	/**
	 * @param string $parent_slug
	 * @param string $page_title
	 * @param string $menu_title
	 * @param string $capability
	 * @param string $menu_slug
	 * @param string $menu_object
	 */
	public function add_sub_menu( $parent_slug = "", $page_title = "", $menu_title = "", $capability = "", $menu_slug = "", $menu_object) {
		$this->sub_menu_pages[ $menu_slug ] = new Menu( $page_title, $menu_title, $capability, $menu_slug, $menu_object, null, null, true, $parent_slug );
	}

	/**
	 * @param $shortcode
	 * @param $class
	 */
	public function add_shortcode( $shortcode, $class ) {
		$this->shortcodes[ $shortcode ] = $class;
	}

	/**
	 * @param string $post_type
	 * @param array  $labels
	 * @param array  $options
	 * @param array  $capabilities
	 * @param array  $supports
	 *
	 * @return Post_Type $post_type_obj
	 */
	public function add_post_type( $post_type = "", $labels = array(), $options = array(), $capabilities = array(), $supports = array() ) {
		$post_type_obj                  = new Post_type( $post_type, $labels, $options, $capabilities, $supports );
		$this->post_types[ $post_type ] = $post_type_obj;

		return $post_type_obj;
	}

	/**
	 * Add actions the the actions array.
	 *
	 * @param $hook
	 * @param $component
	 * @param $callback
	 */
	public function add_action( $hook, $component, $callback ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback );
	}

	/**
	 * Add filters to the filters array
	 *
	 * @param $hook
	 * @param $component
	 * @param $callback
	 */
	public function add_filter( $hook, $component, $callback ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback );
	}

	/**
	 * Adds a new items to one of the arrays
	 *
	 * @param $hooks
	 * @param $hook
	 * @param $component
	 * @param $callback
	 *
	 * @return array
	 */
	private function add( $hooks, $hook, $component, $callback ) {
		$hooks[] = array(
			'hook'      => $hook,
			'component' => $component,
			'callback'  => $callback
		);

		return $hooks;

	}

	/**
	 * Read the actions and filters defined by this plugin.
	 *
	 * @hook plugin_init
	 */
	public function run() {
		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		}
		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		}
		foreach ( $this->shortcodes as $shortcode => $class ) {
			add_shortcode( $shortcode, array( $class, "shortcode" ) );
		}
	}

	/**
	 * Registers all the menu pages
	 *
	 * @hook admin_menu
	 */
	public function register_menus() {
		/**
		 * @var Menu $menu_obj
		 */
		foreach ( $this->menu_pages as $menu_slug => $menu_obj ) {
			add_menu_page( $menu_obj->getPageTitle(), $menu_obj->getMenuTitle(), $menu_obj->getCapability(), $menu_obj->getMenuSlug(), array($menu_obj->getCLass(), "menu_page"), $menu_obj->getIconUrl(), $menu_obj->getPostion() );
		}

		foreach ( $this->sub_menu_pages as $menu_slug => $menu_obj ) {
			add_submenu_page($menu_obj->getParentMenuSlug(), $menu_obj->getPageTitle(), $menu_obj->getMenuTitle(), $menu_obj->getCapability(), $menu_obj->getMenuSlug(),array($menu_obj->getCLass(), "menu_page"));
		}
	}

	/**
	 * Custom post types need to be added right after WordPress is loaded and can't be added together with hooks.
	 *
	 * @hook init - runs when WordPress is first initialized
	 */
	public function wordpress_init() {
		foreach ( $this->post_types as $post_type ) {
			/** @var $post_type Post_Type */
			register_post_type( $post_type->get_post_type(), $post_type->get_args() );
		}
	}
}