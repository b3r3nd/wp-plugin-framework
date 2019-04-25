<?php

namespace Main;
/**
 * We use the Constants Class to define some values used on multiple locations to keep it easy to modify.
 *
 * @package Main
 * @author Berend de Groot <berend@nugtr.nl>
 */
class Plugin {
	/**
	 * Basic plugin variables
	 */
	/** Name of the plugin */
	const NAME = "placeholder";
	/** Short tag for the plugin */
	const SHORTNAME = "placeholder";
	/** Plugin version  */
	const VERSION = "placeholder";
	/** Plugin author */
	const AUTHOR = "placeholder";
	/** Plugin URL */
	const URL = "http://www.nugtr.nl";
	/** Language domain */
	const LANGUAGE_DOMAIN = "placeholder";
	/** Options group for settings */
	const OPTIONS_GROUP = "placeholder";
	/** Main menu on the WordPress Dashboard */
	const MAIN_MENU = "placeholder";
	/** Plugin Options page */
	const OPTIONS_MENU_SLUG = "placeholder";
	/** Plugin Options page title */
	const OPTIONS_PAGE_TITLE = "placeholder";
	/** Plugin Options menu title */
	const OPTIONS_MENU_TITLE = "placeholder";

	/** Booleans to enable/disable parts of the plugin. */

	const ALLOWS_OPTIONS_PAGE = false;
	const ALLOWS_MAIN_MENU_PAGE = false;
	const ALLOWS_SUB_MENU_PAGE = false;
	const ALLOWS_SHORTCODES = false;
	const ALLOWS_PLUGIN_OPTIONS = false;
	const ALLOWS_CUSTOM_POST_TYPES = false;
	const ALLOWS_ACTIONS = false;
	const ALLOWS_FILTERS = false;
	const ALLOWS_TAXONOMIES = false;
	const ALLOWS_SINGLE_TEMPLATE_FILE = false;
	const ALLOWS_ARCHIVE_TEMPLATE_FILE = false;
	const ALLOWS_CUSTOM_POST_CLASS = false;
	const ALLOWS_ADMIN_SCRIPTS = false;
	const ALLOWS_FRONTEND_SCRIPTS = false;
	const ALLOWS_SETUP_HOOKS = false;
	const ALLOWS_META_BOXES = false;
}