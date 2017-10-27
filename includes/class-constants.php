<?php
namespace PT_Setup;
/**
 * We use the Constants Class to define some values used on multiple locations to keep it easy to modify.
 */
class Constants {
	/** Name of the plugin */
	const PLUGIN_NAME = "plugin_template";
	/** Short tag for the plugin */
	const PLUGIN_SHORTNAME = "pt";
	/** Plugin version  */
	const PLUGIN_VERSION = "1.0.0";
	/** Language domain */
	const PLUGIN_LANGUAGE_DOMAIN = "plugin_template_language";
	/** Plugin author */
	const PLUGIN_AUTHOR = "ComSi";
	/** Plugin URL */
	const PLUGIN_URL = "http://plugins.comsi.nl";
	/** setup namespace */
	const PLUGIN_SETUP_NAMESPACE = "PT_Setup";
	/** options group for settings */
	const PLUGIN_OPTIONS_GROUP = "template_plugin";
	/** default options page */
	const PLUGIN_OPTIONS_PAGE = "plugin-template-options";
	/** default options sub page  */
	const PLUGIN_OPTIONS_SUB_PAGE = "plugin-template-options-sub";
	/** default wordpress settings page */
	const SETTINGS_SUB_PAGE = "settings-sub-page";
	/** Define if shortcodes need to be registered */
	const INIT_SHORTCODES = true;
	/** Define if the admin menu needs to be registered */
	const INIT_ADMIN_MENU = true;
	/** Define if post types need to be registered */
	const INIT_POST_TYPES = true;
	/** Define if post types will have their own menu */
	const POST_TYPES_OWN_MENU = true;
	/** Define if the admin scripts needs to be registered in the wp_admin */
	const INIT_ADMIN_SCRIPT = true;
	/** Define if the scripts and styles in the frontend need to be registered */
	const INIT_FRONTEND_SCRIPTS = true;
	/** Define if the plugin settings need to be registered */
	const INIT_PLUGIN_SETTINGS = true;
}