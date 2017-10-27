<?php

namespace Main;

use Main\Custom\Admin;
use Main\Custom\Frontend;
use Main\Custom\Menus\Main_Menu;
use Main\Custom\Menus\Sub_Menu;
use Main\Custom\Setup;
use Main\Custom\Shortcodes\Example_ShortcodeInterface;
use Main\Framework\Entities\Post_Type;
use Main\Framework\Loader;

/**
 * Basic Plugin file were everything is loaded. Keep in mind when adding more and more custom post types, shortcodes,
 * dependencies and other hooks that you start seperating each function in its own file.
 *
 * For smaller plug-ins this including it all in one file like this is fine.
 *
 * @shortcode example_shortcode
 * @post_type Example
 *
 * @action admin_enqueue_scripts
 * @action admin_menu
 * @action wp_enqueue_scripts
 * @action plugin_activation
 * @action plugin_deactivation
 */
class Plugin {
	/** @var  $loader Loader */
	protected $loader;
	protected $plugin_slug;
	protected $version;
	protected $plugin_base_file;
	protected $required_plugins;

	/**
	 * Plugin constructor.
	 *
	 * @param $plugin_base_file
	 */
	public function __construct( $plugin_base_file ) {
		$this->plugin_slug      = Constants::PLUGIN_NAME;
		$this->version          = Constants::PLUGIN_VERSION;
		$this->plugin_base_file = $plugin_base_file;
		$this->load_dependencies();
		$this->define_required_plugins();
		$this->define_setup_hooks();
		$this->define_admin_hooks();
		$this->define_shortcodes();
		$this->define_global_frontend_hooks();
		$this->define_custom_post_types();
		$this->define_menus();

	}

	/**
	 * Loads all the required files and vendors.
	 */
	private function load_dependencies() {
		require_once( 'custom/class-admin.php' );
		require_once( 'custom/class-frontend.php' );
		require_once( 'custom/class-setup.php' );
		require_once( 'custom/shortcodes/class-example-shortcode.php' );
		require_once('custom/menus/class-main-menu.php');
		require_once('custom/menus/class-sub-menu.php');
		$this->loader = new Loader();
	}

	/**
	 * Define required plugins before this plugin can be used.
	 *
	 * @hook plugin_setup - runs when plugin is first setup
	 * @usage array("gravityforms/gravityforms.php")
	 */
	private function define_required_plugins() {
		$required_plugins       = array();
		$this->required_plugins = $required_plugins;
	}

	/**
	 * Define all menus here.
	 */
	private function define_menus() {
		$this->loader->add_menu("Template", "Template", "administrator", Constants::PLUGIN_DASHBOARD_MAIN_MENU, new Main_Menu());
		$this->loader->add_sub_menu(Constants::PLUGIN_DASHBOARD_MAIN_MENU, "Sub Menu", "Sub Menu", "administrator", "template_sub", new Sub_Menu());
	}

	/**
	 * Define all admin hooks.
	 *
	 * @action admin_enqueue_scripts
	 * @action admin_menu
	 * @actionClass  Admin
	 */
	private function define_admin_hooks() {
		$admin = new Admin( $this->version, $this->plugin_base_file );
		$this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_scripts' );


	}

	/**
	 * Define all globally used fronend hooks.
	 *
	 * @action wp_enqueue_scripts
	 * @actionClass Frontend
	 */
	private function define_global_frontend_hooks() {
		$fronend = new Frontend( $this->version, $this->plugin_base_file );
		$this->loader->add_action( "wp_enqueue_scripts", $fronend, "enqueue_scripts" );

	}

	/**
	 * Define all hooks used for plugin management.
	 *
	 * @action activation_hook
	 * @action deactivation hook
	 * @actionClass Setup
	 */
	private function define_setup_hooks() {
		$setup = new Setup( $this->required_plugins );
		register_activation_hook( $this->plugin_base_file, array( $setup, 'activate' ) );
		register_deactivation_hook( $this->plugin_base_file, array( $setup, 'deactivate' ) );
	}

	/**
	 * Define all shortcodes
	 *
	 * @shortcode example_shortcode
	 *
	 */
	private function define_shortcodes() {
		$this->loader->add_shortcode( "example_shortcode", new Example_ShortcodeInterface() );
	}

	/**
	 * Define all custom post types
	 *
	 * @hook init
	 * @post_type Example
	 * @post_supports title
	 * @post_supports revisions
	 * @post_supports thumbnail
	 * @post_caps post
	 * @showui options-page
	 */
	private function define_custom_post_types() {
		/** @var Post_Type $example_post */
		$example_post = $this->loader->add_post_type( "Example" );
		$example_post->set_option( 'show_in_menu', Constants::PLUGIN_DASHBOARD_MAIN_MENU );
		$example_post->set_option( "show_ui", true );
		$example_post->set_supports( array( "title", "revisions", "thumbnail" ) );
		$example_post->set_label( 'all_items', "Examples" );
	}

	public function run() {
		$this->loader->run();
	}

	/**
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}
}