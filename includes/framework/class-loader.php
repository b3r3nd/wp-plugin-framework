<?php

namespace Main\Framework;

use Main\Plugin;
use Main\Custom\Scripts;
use Main\Framework\Classes\Menu;
use Main\Framework\Classes\Option;
use Main\Framework\Classes\Post_Type;
use Main\Framework\Classes\Taxonomy;
use Main\Custom\Setup;
use Main\Plugin_Main;

/**
 * Loader class, used to register all actions, filters, post types, taxonomies, shortcodes, menu pages and settings.
 *
 * @package Main\Framework
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
	protected $plugin;

	/**
	 * Loader constructor.
	 *
	 * @param $plugin
	 */
	public function __construct($plugin ) {
		/** @var  $plugin Plugin_Main */
		$this->actions          = array();
		$this->filters          = array();
		$this->post_types       = array();
		$this->taxonomies       = array();
		$this->shortcodes       = array();
		$this->menu_pages       = array();
		$this->plugin_options   = array();
		$this->plugin = $plugin;

		$this->add_action( "init", $this, "wordpress_init" );
		$this->add_action( "admin_menu", $this, "register_menus" );
		if ( Plugin::ALLOWS_SINGLE_TEMPLATE_FILE ) {
			$this->add_filter( "single_template", $this, "register_single_template" );
		}
		if ( Plugin::ALLOWS_ARCHIVE_TEMPLATE_FILE ) {
			$this->add_filter( "archive_template", $this, "register_archive_template" );
		}
		if ( Plugin::ALLOWS_ADMIN_SCRIPTS ) {
			$this->add_action( 'admin_enqueue_scripts', new Scripts( $plugin->get_version(), $plugin->get_plugin_base_file() ), 'admin_enqueue_scripts' );
		}
		if ( Plugin::ALLOWS_FRONTEND_SCRIPTS ) {
			$this->add_action( "wp_enqueue_scripts", new Scripts( $plugin->get_version(), $plugin->get_plugin_base_file() ), "frontend_enqueue_scripts" );
		}
		if(Plugin::ALLOWS_SETUP_HOOKS) {
			$setup = new Setup( $plugin->get_required_plugins() );
			register_activation_hook( $plugin->get_plugin_base_file(), array( $setup, 'activate' ) );
			register_deactivation_hook( $plugin->get_plugin_base_file(), array( $setup, 'deactivate' ) );
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
	 * @param $priority
	 * @param $accepted_args
	 */
	public function add_action( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->actions = $this->add( $this->actions, $hook, $component, $callback, $priority, $accepted_args );
	}

	/**
	 * Add filters to the filters array
	 *
	 * @param $hook
	 * @param $component
	 * @param $callback
	 * @param $priority
	 * @param $accepted_args
	 */
	public function add_filter( $hook, $component, $callback, $priority = 10, $accepted_args = 1 ) {
		$this->filters = $this->add( $this->filters, $hook, $component, $callback, $priority, $accepted_args );
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
	 * Read the actions and filters defined by this plugin.
	 *
	 * @hook plugin_init
	 */
	public function run() {
		if ( Plugin::ALLOWS_CUSTOM_POST_CLASS ) {
			$this->register_post_wrapper();
		}
		if ( Plugin::ALLOWS_FILTERS ) {
			foreach ( $this->filters as $hook ) {
				add_filter( $hook['hook'], array(
					$hook['component'],
					$hook['callback']
				), $hook['priority'], $hook['accepted_args'] );
			}
		}
		if ( Plugin::ALLOWS_ACTIONS ) {
			foreach ( $this->actions as $hook ) {
				add_action( $hook['hook'], array(
					$hook['component'],
					$hook['callback']
				), $hook['priority'], $hook['accepted_args'] );
			}
		}
		if ( Plugin::ALLOWS_SHORTCODES ) {
			foreach ( $this->shortcodes as $shortcode => $class ) {
				add_shortcode( $shortcode, array( $class, "shortcode" ) );
			}
		}
		if ( Plugin::ALLOWS_PLUGIN_OPTIONS ) {
			foreach ( $this->plugin_options as $plugin_setting ) {
				register_setting( Plugin::OPTIONS_GROUP, $plugin_setting->getName() );
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
		if ( Plugin::ALLOWS_MAIN_MENU_PAGE ) {
			foreach ( $this->menu_pages as $menu_slug => $menu_obj ) {
				add_menu_page( $menu_obj->getPageTitle(), $menu_obj->getMenuTitle(), $menu_obj->getCapability(), $menu_obj->getMenuSlug(), array(
					$menu_obj->getCLass(),
					"menu_page"
				), $menu_obj->getIconUrl(), $menu_obj->getPostion() );
			}
		}
		if ( Plugin::ALLOWS_SUB_MENU_PAGE ) {
			foreach ( $this->sub_menu_pages as $menu_slug => $menu_obj ) {
				add_submenu_page( $menu_obj->getParentMenuSlug(), $menu_obj->getPageTitle(), $menu_obj->getMenuTitle(), $menu_obj->getCapability(), $menu_obj->getMenuSlug(), array(
					$menu_obj->getCLass(),
					"menu_page"
				) );
			}
		}
		if ( Plugin::ALLOWS_OPTIONS_PAGE ) {
			$options_page = new Options_page( $this->plugin_options );
			add_options_page( Plugin::OPTIONS_PAGE_TITLE, Plugin::OPTIONS_MENU_TITLE, "administrator", Plugin::OPTIONS_MENU_SLUG, array(
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
	 * This functions registers the actions for custom post types. They refer to a wrapper class which from there
	 * will call the right function in the custom post class (if enabled).
	 */
	public function register_post_wrapper() {
		$post_wrapper = new Post_Wrapper( $this->post_types );
		$this->add_action( "save_post", $post_wrapper, "save_post", 10, 2 );
		$this->add_action( "wp_trash_post", $post_wrapper, "trash_post", 10, 1 );
		$this->add_action( "before_delete_post", $post_wrapper, "before_delete_post", 10, 1 );
		$this->add_action( "untrash_post", $post_wrapper, "untrash_post", 10, 1 );
		$this->add_action( "transition_post_status", $post_wrapper, "transition_post_status", 10, 3 );
	}

	/**
	 * Custom post types need to be added right after WordPress is loaded and can't be added together with hooks.
	 * The same for the taxonomies used by these custom post types.
	 *
	 * @hook init - runs when WordPress is first initialized
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
							register_taxonomy( $taxonomy->getTaxonomy(), $taxonomy->getPostType(), $taxonomy->getArgs() );
						}
					}
				}
			}
		}
	}
}