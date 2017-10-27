<?php
namespace PT_Setup;
/**
 * Loader class, used to load actions and filets.
 */
class Loader {
	protected $actions;
	protected $filters;
	protected $post_types;
	protected $taxonomies;
	protected $shortcodes;
	protected $menu_pages;
	protected $plugin_settings;


	public function __construct() {
		$this->actions = array();
		$this->filters = array();
	}

	/**
	 * Add actions the the actions array.
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
	 * Adds a new hook to the hook array.
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
		foreach ( $this->filters as $hook ) {
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		}
		foreach ( $this->actions as $hook ) {
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		}

	}
}