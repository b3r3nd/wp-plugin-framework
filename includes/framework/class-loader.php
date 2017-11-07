<?php

namespace Main\Framework;

use Main\Constants;
use Main\Framework\Entities\Menu;
use Main\Framework\Entities\Option;
use Main\Framework\Entities\Post_Type;
use Main\Framework\Entities\Taxonomy;

/**
 * Loader class, used to register all actions, filters, post types, taxonomies, shortcodes, menu pages and settings.
 */
class Loader {
	protected $actions;
	protected $filters;
	protected $post_types;
	protected $shortcodes;
	protected $menu_pages;
	protected $sub_menu_pages;
	protected $plugin_options;
	protected $admin_scripts;
	protected $frontend_scripts;

	/**
	 * Loader constructor.
	 */
	public function __construct() {
		$this->actions        = array();
		$this->filters        = array();
		$this->post_types     = array();
		$this->taxonomies     = array();
		$this->shortcodes     = array();
		$this->menu_pages     = array();
		$this->plugin_options = array();
		$this->add_action( "init", $this, "wordpress_init" );
		$this->add_action( "admin_menu", $this, "register_menus" );
		if ( Constants::ALLOW_SINGLE_TEMPLATE_FILES ) {
			$this->add_filter( "single_template", $this, "register_single_template" );
		}
		if(Constants::ALLOW_ARCHIVE_TEMPLATE_FILES) {
			$this->add_filter( "archive_template", $this, "register_archive_template" );

		}
	}

	/**
	 * @param $name
	 * @param $type
	 * @param $label
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
	public function add_sub_menu( $parent_slug = "", $page_title = "", $menu_title = "", $capability = "", $menu_slug = "", $menu_object ) {
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
		$post_type_obj                                = new Post_type( strtolower( $post_type ), $labels, $options, $capabilities, $supports );
		$this->post_types[ strtolower( $post_type ) ] = $post_type_obj;

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
		if ( Constants::REGISTER_FILTERS ) {
			foreach ( $this->filters as $hook ) {
				add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
			}
		}
		if ( Constants::REGISTER_ACTIONS ) {
			foreach ( $this->actions as $hook ) {
				add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
			}
		}
		if ( Constants::REGISTER_SHORTCODES ) {
			foreach ( $this->shortcodes as $shortcode => $class ) {
				add_shortcode( $shortcode, array( $class, "shortcode" ) );
			}
		}
		if ( Constants::REGISTER_PLUGIN_OPTIONS ) {
			foreach ( $this->plugin_options as $plugin_setting ) {
				register_setting( Constants::PLUGIN_OPTIONS_GROUP, $plugin_setting->getName() );
			}
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
		if ( Constants::REGISTER_MAIN_MENU_PAGE ) {
			foreach ( $this->menu_pages as $menu_slug => $menu_obj ) {
				add_menu_page( $menu_obj->getPageTitle(), $menu_obj->getMenuTitle(), $menu_obj->getCapability(), $menu_obj->getMenuSlug(), array(
					$menu_obj->getCLass(),
					"menu_page"
				), $menu_obj->getIconUrl(), $menu_obj->getPostion() );
			}
		}
		if ( Constants::REGISTER_SUB_MENU_PAGE ) {
			foreach ( $this->sub_menu_pages as $menu_slug => $menu_obj ) {
				add_submenu_page( $menu_obj->getParentMenuSlug(), $menu_obj->getPageTitle(), $menu_obj->getMenuTitle(), $menu_obj->getCapability(), $menu_obj->getMenuSlug(), array(
					$menu_obj->getCLass(),
					"menu_page"
				) );
			}
		}
		if ( Constants::REGISTER_OPTIONS_PAGE ) {
			$options_page = new Options_page( $this->plugin_options );
			add_options_page( Constants::PLUGIN_OPTIONS_PAGE_TITLE, Constants::PLUGIN_OPTIONS_MENU_TITLE, "administrator", Constants::PLUGIN_OPTIONS_MENU_SLUG, array(
				$options_page,
				"menu_page"
			) );
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
	 */
	public function register_single_template( $single_template ) {
		global $post;
		if ( array_key_exists( $post->post_type, $this->post_types ) ) {
			$custom_post_type = $this->post_types[ $post->post_type ];
			/** @var $custom_post_type Post_Type */
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
	 */
	public function register_archive_template( $archive_template ) {
		global $post;
		if ( array_key_exists( $post->post_type, $this->post_types ) ) {
			$custom_post_type = $this->post_types[ $post->post_type ];
			/** @var $custom_post_type Post_Type */
			if ( $custom_post_type->get_archive_template() !== false ) {
				$archive_template = $custom_post_type->get_archive_template();
			}
		}

		return $archive_template;
	}

	/**
	 * Custom post types need to be added right after WordPress is loaded and can't be added together with hooks.
	 * The same for the taxonomies used by these custom post types.
	 *
	 * @hook init - runs when WordPress is first initialized
	 */
	public function wordpress_init() {
		if ( Constants::REGISTER_CUSTOM_POST_TYPES ) {
			foreach ( $this->post_types as $post_type ) {
				/** @var $post_type Post_Type */
				register_post_type( $post_type->get_post_type(), $post_type->get_args() );
				if ( Constants::REGISTER_TAXONOMIES ) {
					foreach ( $post_type->get_taxonomies() as $taxonomy ) {
						/** @var $taxonomy Taxonomy */
						register_taxonomy( $taxonomy->getTaxonomy(), $taxonomy->getPostType(), $taxonomy->getArgs() );
					}
				}
			}
		}
	}
}