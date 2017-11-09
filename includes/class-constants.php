<?php

namespace Main;
/**
 * We use the Constants Class to define some values used on multiple locations to keep it easy to modify.
 *
 * @package Main
 */
class Constants {
	/**
	 * Basic plugin variables
	 */
	/** Name of the plugin */
	const PLUGIN_NAME = "plugin_template";
	/** Short tag for the plugin */
	const PLUGIN_SHORTNAME = "pt";
	/** Plugin version  */
	const PLUGIN_VERSION = "1.0.0";
	/** Plugin author */
	const PLUGIN_AUTHOR = "ComSi";
	/** Plugin URL */
	const PLUGIN_URL = "http://plugins.comsi.nl";
	/** Language domain */
	const PLUGIN_LANGUAGE_DOMAIN = "plugin_template_language";
	/** Options group for settings */
	const PLUGIN_OPTIONS_GROUP = "template_plugin";
	/** Main menu on the WordPress Dashboard */
	const PLUGIN_DASHBOARD_MAIN_MENU = "template-main-menu-item";
	/** Plugin Options page */
	const PLUGIN_OPTIONS_MENU_SLUG = "template-options";
	/** Plugin Options page title */
	const PLUGIN_OPTIONS_PAGE_TITLE = "Template Options";
	/** Plugin Options menu title */
	const PLUGIN_OPTIONS_MENU_TITLE = "Template Options";
	/**
	 * Booleans to enable/disable parts of the plugin.
	 */
	const REGISTER_OPTIONS_PAGE        = true;
	const REGISTER_MAIN_MENU_PAGE      = true;
	const REGISTER_SUB_MENU_PAGE       = true;
	const REGISTER_SHORTCODES          = true;
	const REGISTER_PLUGIN_OPTIONS      = true;
	const REGISTER_CUSTOM_POST_TYPES   = true;
	const REGISTER_ACTIONS             = true;
	const REGISTER_FILTERS             = true;
	const REGISTER_TAXONOMIES          = true;
	const ALLOW_SINGLE_TEMPLATE_FILES  = false;
	const ALLOW_ARCHIVE_TEMPLATE_FILES = false;
	const ALLOW_CUSTOM_POST_CLASS      = true;
}