<?php
namespace PT_Setup;
/**
 * The Admin class handles everything related to the WP_ADMIN, this will be mostly styles and admin menu's.
 */
class Admin {
	private $version;

	/**
	 * @param $version
	 */
	public function __construct( $version ) {
		$this->version = $version;
		if(Constants::INIT_PLUGIN_SETTINGS) {
			$this->register_settings();
		}
	}

	/**
	 * Enqueues styles used in the WP_ADMIN
     *
     * @hook admin_enqueue_styles
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( Constants::PLUGIN_SHORTNAME . "-css-admin", plugin_dir_url( __DIR__ ) . "css/admin.css", array(), $this->version, false );
		wp_enqueue_script( Constants::PLUGIN_SHORTNAME . "-js-admin", plugin_dir_url( __DIR__ ) . "js/admin.js", array(), $this->version, false );
	}

	/**
	 * Register settings available in the WP_Admin
     *
     * @hook plugin_init
	 */
	public function register_settings() {
		register_setting(Constants::PLUGIN_OPTIONS_GROUP, "ExampleOption");
	}

	/**
	 * Adds three example menus items: Main menu item, sub menu item & settings menu item.
     *
     * @hook admin_menu
	 */
	public function register_menus() {
		add_menu_page( __( "Template Plugin", Constants::PLUGIN_LANGUAGE_DOMAIN ), __( "Template Plugin", Constants::PLUGIN_LANGUAGE_DOMAIN ), "administrator", Constants::PLUGIN_OPTIONS_PAGE, array($this, "menu_page"));
		add_submenu_page(Constants::PLUGIN_OPTIONS_PAGE,  __( "Settings", Constants::PLUGIN_LANGUAGE_DOMAIN ),  __( "Settings", Constants::PLUGIN_LANGUAGE_DOMAIN ), "administrator", Constants::PLUGIN_OPTIONS_SUB_PAGE, array($this, "submenu_page"));
		add_submenu_page("options-general.php",  __( "Plugin Template", Constants::PLUGIN_LANGUAGE_DOMAIN ),  __( "Plugin Template", Constants::PLUGIN_LANGUAGE_DOMAIN ), "administrator", Constants::SETTINGS_SUB_PAGE, array($this, "settings_submenu_page"));

	}

	/**
	 * Page for the main menu entry.
     *
     * @hook menu_page
	 */
	public function menu_page() {
		echo "Menu page";
	}

	/**
	 * Page for the sub menu entry.
     *
     * @hook sub_menu_page
	 */
	public function submenu_page() {
		echo "Submenu page";
	}

	/**
	 * Page for the settings entry.
     *
     * @hook settings_menu_page
	 */
	public function settings_submenu_page() {
		?>
		<form method="post" action="options.php">
			<?php
			settings_fields(Constants::PLUGIN_OPTIONS_GROUP);
			do_settings_sections(Constants::PLUGIN_OPTIONS_GROUP);
			?>
			<div class="wrap">
				<h1><?php echo __('Plugin Settings', Constants::PLUGIN_LANGUAGE_DOMAIN); ?></h1>
				<table class="form-table">
					<tbody>
					<tr>
						<th scope="row"><label for="ExampleOption"><?php echo __('Example Option', Constants::PLUGIN_LANGUAGE_DOMAIN); ?></th>
						<td><input type="text" name="ExampleOption" id="ExampleOption" class="regular-text" value="<?php echo get_option("ExampleOption"); ?>" /></td>
					</tr>
					</tbody>
				</table>
				<p class="submit"><?php submit_button(); ?></p>
			</div>
		</form>
		<?php
	}
}