<?php

namespace Main\Framework;

use Main\Framework\Classes\Menu;
use Main\Framework\Classes\Option;
use Main\Framework\Classes\Post_Type;
use Main\Framework\Classes\Taxonomy;
use Main\Framework\Loader\Meta_Box_Loader;
use Main\Framework\Loader\Options_Loader;
use Main\Framework\Loader\Script_Setup_Loader;
use Main\Plugin;
use Main\Plugin_Main;
use Main\Framework\Loader\Menu_Loader;
use Main\Framework\Loader\Hook_loader;
use Main\Framework\Loader\Custom_Post_Loader;
use Main\Framework\Loader\Shortcode_Loader;

/**
 * Loader class, used to register all actions, filters, post types, taxonomies, shortcodes, menu pages and settings.
 * It calls on different loaders to keep it readable, although the loader class is still the only class called
 * to add functionality to the plug-in.
 *
 * We have two hooks in this class, for plugin and wordpress init.
 *
 * @package Main\Framework
 * @author  Berend de Groot <berend@nugtr.nl>
 */
class Loader {
	public $actions;
	public $filters;
	public $post_types;
	public $shortcodes;
	public $meta_box_groups;
	public $menu_pages;
	public $sub_menu_pages;
	public $plugin_options;
	public $admin_scripts;
	public $frontend_scripts;
	public $plugin;
	public $custom_post_loader;
	public $menu_loader;
	public $hook_loader;
	public $shortcode_loader;
	public $script_setup_loader;
	public $options_loader;
	public $meta_box_loader;
	private static $loader;

	/**
	 * Loader constructor.
	 *
	 * @param $plugin
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function __construct( $plugin ) {
		$this->actions         = array();
		$this->filters         = array();
		$this->post_types      = array();
		$this->shortcodes      = array();
		$this->menu_pages      = array();
		$this->plugin_options  = array();
		$this->meta_box_groups = array();
		$this->plugin          = $plugin;
		self::$loader = $this;
		$this->loaders();
		$this->add_action( "init", $this, "wordpress_init" );
		$this->add_action( "admin_menu", $this->menu_loader, "register_menus" );
		$this->script_setup_loader->plugin_setup();
	}

	/**
	 * In some cases we need to retrieve the main loader instance to access loaded components. Instead of passing
	 * the loader everywhere it is "kinda" a singleton, except for the fact it does not create a new instance
	 * if none is found.
	 *
	 * @return bool|\Main\Framework\Loader
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public static function get_instance() {
		if(self::$loader) {
			return self::$loader;
		}
		return false;
	}

	/**
	 * Hook runs on Plugin Init.
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function run() {
		if ( Plugin::ALLOWS_CUSTOM_POST_CLASS ) {
			$this->custom_post_loader->register_post_wrapper();
		}
		if ( Plugin::ALLOWS_META_BOXES ) {
			$this->meta_box_loader->register_meta_box_action();
		}
		if ( Plugin::ALLOWS_FILTERS ) {
			$this->hook_loader->register_filters();
		}
		if ( Plugin::ALLOWS_ACTIONS ) {
			$this->hook_loader->register_actions();
		}
		if ( Plugin::ALLOWS_SHORTCODES ) {
			$this->shortcode_loader->register_shortcodes();
		}
		if ( Plugin::ALLOWS_PLUGIN_OPTIONS ) {
			$this->options_loader->register_plugin_options();
		}

	}

	/**
	 * Loaders for all different parts.
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function loaders() {
		$this->custom_post_loader  = new Custom_Post_Loader();
		$this->menu_loader         = new Menu_Loader();
		$this->hook_loader         = new Hook_loader();
		$this->shortcode_loader    = new Shortcode_Loader();
		$this->options_loader      = new Options_Loader();
		$this->script_setup_loader = new Script_Setup_Loader();
		$this->meta_box_loader     = new Meta_Box_Loader();
	}

	/**
	 * Hooks runs on WordPress Init.
	 *
	 * Custom post types need to be added right after WordPress is loaded and can't be added on Plugin Init.
	 * The same for the taxonomies used by these custom post types.
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function wordpress_init() {
		if ( Plugin::ALLOWS_CUSTOM_POST_TYPES ) {
			foreach ( $this->post_types as $post_type ) {
				/** @var $post_type Post_Type */
				register_post_type( $post_type->get_post_type(), $post_type->get_args() );
				if ( Plugin::ALLOWS_TAXONOMIES ) {
					if ( $post_type->get_taxonomies() !== false ) {
						foreach ( $post_type->get_taxonomies() as $taxonomy ) {
							/** @var $taxonomy Taxonomy */
							register_taxonomy( $taxonomy->get_taxonomy(), $taxonomy->get_post_type(), $taxonomy->get_args() );
						}
					}
				}
			}
		}
	}


	/**
	 * Add actions the the actions array.
	 *
	 * @param $hook
	 * @param $component
	 * @param $callback
	 * @param $priority
	 * @param $accepted_args
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Adds a new items to one of the arrays
	 *
	 * @param $hooks
	 * @param $hook
	 * @param $component
	 * @param $callback
	 * @param $priority
	 * @param $accepted_args
	 *
	 * @return array
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	private function add( $hooks, $hook, $component, $callback, $priority, $accepted_args ) {
		$hooks[] = array(
			'hook'          => $hook,
			'component'     => $component,
			'callback'      => $callback,
			'priority'      => $priority,
			'accepted_args' => $accepted_args
		);

		return $hooks;

	}

	/**
	 * Add filters to the filters array
	 *
	 * @param $hook
	 * @param $component
	 * @param $callback
	 * @param $priority
	 * @param $accepted_args
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * @param $name
	 * @param $type
	 * @param $label
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function add_option( $name, $type, $label ) {
		$plugin_option                 = new Option( $name, $type, $label );
		$this->plugin_options[ $name ] = $plugin_option;
	}

	/**
	 * @param string $page_title
	 * @param string $menu_title
	 * @param string $capability
	 * @param string $menu_slug
	 * @param string $menu_object
	 * @param string $icon_url
	 * @param int    $postion
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
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
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function add_sub_menu( $parent_slug = "", $page_title = "", $menu_title = "", $capability = "", $menu_slug = "", $menu_object ) {
		$this->sub_menu_pages[ $menu_slug ] = new Menu( $page_title, $menu_title, $capability, $menu_slug, $menu_object, null, null, true, $parent_slug );
	}

	/**
	 * @param $shortcode
	 * @param $class
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
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
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function add_post_type( $post_type = "", $labels = array(), $options = array(), $capabilities = array(), $supports = array() ) {
		$post_type_obj                                = new Post_type( strtolower( $post_type ), $labels, $options, $capabilities, $supports );
		$this->post_types[ strtolower( $post_type ) ] = $post_type_obj;

		return $post_type_obj;
	}


	/**
	 * @return array
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function get_meta_box_groups() {
		return $this->meta_box_groups;
	}

	/**
	 * @param $name
	 *
	 * @return mixed
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function get_meta_box_group($name) {
		return $this->meta_box_groups[sanitize_key($name)];
	}


	/**
	 * @param $meta_box_group
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function add_meta_box_group( $meta_box_group ) {
		$this->meta_box_groups[sanitize_key($meta_box_group->get_label())] = $meta_box_group;
	}
}