<?php

namespace Main;
/**
 * We use the Constants Class to define some values used on multiple locations to keep it easy to modify.
 *
 * @package Main
 */
class Plugin {
	/**
	 * Basic plugin variables
	 */
	/** Name of the plugin */
	const NAME = "plugin_template";
	/** Short tag for the plugin */
	const SHORTNAME = "pt";
	/** Plugin version  */
	const VERSION = "1.0.0";
	/** Plugin author */
	const AUTHOR = "ComSi";
	/** Plugin URL */
	const URL = "http://plugins.comsi.nl";
	/** Language domain */
	const LANGUAGE_DOMAIN = "plugin_template_language";
	/** Options group for settings */
	const OPTIONS_GROUP = "template_plugin";
	/** Main menu on the WordPress Dashboard */
	const MAIN_MENU = "template-main-menu-item";
	/** Plugin Options page */
	const OPTIONS_MENU_SLUG = "template-options";
	/** Plugin Options page title */
	const OPTIONS_PAGE_TITLE = "Template Options";
	/** Plugin Options menu title */
	const OPTIONS_MENU_TITLE = "Template Options";
	/**
	 * Booleans to enable/disable parts of the plugin.
	 */
	const ALLOWS_OPTIONS_PAGE          = false;
	const ALLOWS_MAIN_MENU_PAGE        = false;
	const ALLOWS_SUB_MENU_PAGE         = false;
	const ALLOWS_SHORTCODES            = false;
	const ALLOWS_PLUGIN_OPTIONS        = false;
	const ALLOWS_CUSTOM_POST_TYPES     = false;
	const ALLOWS_ACTIONS               = true;
	const ALLOWS_FILTERS               = true;
	const ALLOWS_TAXONOMIES            = false;
	const ALLOWS_SINGLE_TEMPLATE_FILE  = false;
	const ALLOWS_ARCHIVE_TEMPLATE_FILE = false;
	const ALLOWS_CUSTOM_POST_CLASS     = false;
	const ALLOWS_ADMIN_SCRIPTS         = true;
	const ALLOWS_FRONTEND_SCRIPTS      = true;
	const ALLOWS_SETUP_HOOKS           = true;
}