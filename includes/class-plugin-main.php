<?php

namespace Main;

use Main\Custom\Custom_Post_Types\Test;
use Main\Custom\Menus\Main_Menu;
use Main\Custom\Menus\Sub_Menu;
use Main\Framework\Abstracts\Abstract_Plugin_Main;
use Main\Framework\Classes\Post_Type;
use Main\Framework\Loader;

/**
 * Basic Plugin file were everything is loaded and configured. Keep in mind when adding more and more custom post types, shortcodes,
 * dependencies and other hooks that you start seperating each function in its own file.
 *
 * For smaller plug-ins including it all in one file like this is fine.
 *
 * @package Main
 * @author Berend de Groot <berend@nugtr.nl>
 */
class Plugin_Main extends Abstract_Plugin_Main {
	/** @var  $loader Loader */
	protected $loader;
	protected $version;
	protected $plugin_base_file;
	protected $required_plugins;

	/**
	 * Plugin constructor.
	 *
	 * @param $plugin_base_file
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function __construct( $plugin_base_file ) {
		$this->version          = Plugin::VERSION;
		$this->plugin_base_file = $plugin_base_file;
		$this->load_dependencies();
		$this->loader = new Loader( $this );
		$this->define_required_plugins();
		$this->define_shortcodes();
		$this->define_custom_post_types();
		$this->define_menus();
		$this->define_plugin_options();
	}


	/**
	 * This function load all the required dependencies not added by the default framework, if you added a new class
	 * please include it here.
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	private function load_dependencies() {
		require_once( 'custom/shortcodes/class-example-shortcode.php' );
		require_once( 'custom/post-types/class-test.php' );
	}

	/**
	 * This function is used to define plugin which need to be installed before this plugin can be activated.
	 *
	 * @usage array("gravityforms/gravityforms.php")
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	private function define_required_plugins() {
		$required_plugins       = array();
		$this->required_plugins = $required_plugins;
	}

	/**
	 * This function is used to define any shortcodes which the plugin uses. When you want to register a new shortcode
	 * you should create a new class in the includes/custom/shortcodes folder and implement the shortcode interface.
	 * You will be asked to overwrite a function called shortcode, this function will be called when the shortcode
	 * is used.
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	private function define_shortcodes() {
		$this->loader->add_shortcode( 'test', new Test() );
	}

	/**
	 * This function is used to define all custom post types used by the plugin. See the add_post_type function for
	 * all parameters. You can provide all parameters or simply pass the name and add options later if required.
	 *
	 * The add_post_type functions returns the post_type Object, you can use this object to modify the custom post type.
	 * Say for example you want to add new taxonomies, provide the supported items or labels, or overwrite template
	 * filese. All can be done afterwards.
	 *
	 * I added a couple of examples below how to add and modify a custom post type.
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	private function define_custom_post_types() {
		/** @var Post_Type $example_post */
		$example_post = $this->loader->add_post_type( "example" );
		$example_post->set_option( 'show_in_menu', 1 );
		$example_post->set_option( "show_ui", true );
		$example_post->set_options( array( 'public' => true, "has_archive" => true ) );
		$example_post->set_supports( array( "title", "revisions", "thumbnail" ) );
		$example_post->set_labels( array(
			"all_items"     => "example",
			"name"          => "example",
			"singular_name" => "example",
			"new_item"      => "example",
			"add_new"       => "example",
			"add_item"      => "examplen",
			"add_new_item"  => "example"

		) );
		$example_post->set_single_template( plugin_dir() . "/includes/custom/templates/single-example.php" );
		$example_post->set_archive_template( plugin_dir() . "/includes/custom/templates/archive-example.php" );
		$example_post->set_post_object( new Test() );
		$example_post->add_taxonomy( "Taxonomy",
			array(
				"labels"       => array(
					"all_items"     => "Taxonomies",
					"name"          => "Taxonomy",
					"singular_name" => "Taxonomy",
					"new_item"      => "New Taxonomy",
					"add_new"       => "Add Taxonomy",
					"add_item"      => "Add Taxonomy",
					"add_new_item"  => "New Taxonomy"
				),
				"hierarchical" => "false",
			)
		);
	}

	/**
	 * This function is used to define any extra menu items or sub menu items.
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	private function define_menus() {
		$this->loader->add_menu( "Test", "Test", "administrator", "test", new Main_Menu() );
		$this->loader->add_sub_menu( "test", "Sub Test", "Sub Test", "administrator", "test_sub", new Sub_Menu() );
	}

	/**
	 * This function is used to add all options needed by the plugin.
	 *
	 * @author Berend de Groot <berend@nugtr.nl>
	 */
	public function define_plugin_options() {
		$this->loader->add_option( "test", "input", "Test" );
	}
}