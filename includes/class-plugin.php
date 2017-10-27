<?php

namespace PT_Setup;

use PT_Shortcodes\Example_Shortcode;
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
	/** @var  $loader Loader  */
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

		$this->loader->add_action( "init", $this, "wordpress_init" );
	}

	/**
	 * Used to define custom post types. Custom post types need to be added right after WordPress is loaded, not
	 * when the plugin is loaded.
	 *
	 * @hook init - runs when WordPress is first initialized
	 * @calls define_custom_post_types
	 */
	public function wordpress_init() {
		if(Constants::INIT_POST_TYPES) {
			$this->define_custom_post_types();
		}
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
	 * Loads all the required files and vendors.
	 */
	private function load_dependencies() {
		require_once( 'class-loader.php' );
		require_once( 'class-admin.php' );
		require_once( 'class-frontend.php' );
		require_once( 'class-setup.php' );
		require_once( 'shortcodes/class-example-shortcode.php' );
		$this->loader = new Loader();

	}

	/**
	 * Define all shortcodes
	 * @shortcode example_shortcode
	 *
	 */
	private function define_shortcodes() {
		$exampleShortcode = new Example_Shortcode();
		add_shortcode( "example_shortcode", array( $exampleShortcode, "shortcode" ) );

	}

	/**
	 * Define all admin hooks.
	 *
	 * @action admin_enqueue_scripts
	 * @action admin_menu
	 * @actionClass  Admin
	 */
	private function define_admin_hooks() {
		$admin = new Admin( $this->version );
		if(Constants::INIT_ADMIN_SCRIPT) {
			$this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_scripts' );
		}
		if(Constants::INIT_ADMIN_MENU) {
			$this->loader->add_action( "admin_menu", $admin, "register_menus" );
		}
	}

	/**
	 * Define all globally used fronend hooks.
	 *
	 * @action wp_enqueue_scripts
	 * @actionClass Frontend
	 */
	private function define_global_frontend_hooks() {
		$fronend = new Frontend( $this->version );
		if(Constants::INIT_FRONTEND_SCRIPTS) {
			$this->loader->add_action( "wp_enqueue_scripts", $fronend, "enqueue_scripts" );
		}
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
	 * Define all custom post types, function is executed on the WordPress "init" hook.
	 *
	 * @post_type Example
	 * @post_supports title
	 * @post_supports revisions
	 * @post_supports thumbnail
	 * @post_caps post
	 * @showui options-page
	 */
	private function define_custom_post_types() {
		$labels = array(
			'name'               => __( "Examples", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'singular_name'      => __( "Example", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'menu_name'          => __( "Example", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'name_admin_bar'     => __( "Example", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'add_new'            => __( "New Example", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'add_new_item'       => __( "Add new Example", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'new_item'           => __( "New Example", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'edit_item'          => __( "Edit Example", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'view_item'          => __( "View Example", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'all_items'          => __( "All Examples", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'search_items'       => __( "Search Examples", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'parent_item_colon'  => __( "Parent Example", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'not_found'          => __( "No Examples found", Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'not_found_in_trash' => __( "No Examples found in trash", Constants::PLUGIN_LANGUAGE_DOMAIN )
		);
		$args   = array(
			'labels'             => $labels,
			'description'        => __( 'Examples', Constants::PLUGIN_LANGUAGE_DOMAIN ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => Constants::PLUGIN_OPTIONS_PAGE,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'example' ),
			'capability_type'    => 'post',
			'capabilities'       => array(
				'edit_post'            => 'edit_post',
				'read_post'            => 'read_post',
				'delete_post'          => 'delete_post',
				'delete_posts'         => 'delete_teams',
				'edit_posts'           => 'delete_posts',
				'edit_others_posts'    => 'edit_others_posts',
				'delete_others_posts'  => 'delete_others_posts',
				'publish_posts'        => 'publish_posts',
				'read_private_posts'   => 'read_private_posts',
				'delete_private_posts' => 'delete_private_posts',
			),
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array( 'title', 'revisions', 'thumbnail' )
		);
		register_post_type( "Example", $args );
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