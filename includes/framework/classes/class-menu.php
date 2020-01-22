<?php

namespace Main\Framework\Classes;
/**
 * Class Menu
 *
 * @package Main\Framework\Entities
 * @author  Berend de Groot <berend@nugtr.nl>
 */
class Menu {
	private $page_title;
	private $menu_title;
	private $capability;
	private $menu_slug;
	private $menu_object;
	private $icon_url;
	private $position;
	private $is_sub_menu;
	private $parent_menu_slug;

	/**
	 * Menu constructor.
	 *
	 * @param string $page_title
	 * @param string $menu_title
	 * @param string $capability
	 * @param string $menu_slug
	 * @param        $menu_object
	 * @param        $icon_url
	 * @param        $position
	 * @param bool   $is_sub_menu
	 * @param string $parent_menu_slug
	 */
	function __construct( $page_title = "", $menu_title = "", $capability = "", $menu_slug = "", $menu_object, $icon_url, $position, $is_sub_menu = false, $parent_menu_slug = "" ) {
		$this->page_title       = $page_title;
		$this->menu_title       = $menu_title;
		$this->capability       = $capability;
		$this->menu_slug        = $menu_slug;
		$this->menu_object      = $menu_object;
		$this->icon_url         = $icon_url;
		$this->position         = $position;
		$this->is_sub_menu      = $is_sub_menu;
		$this->parent_menu_slug = $parent_menu_slug;
	}

	/**
	 * @return string
	 */
	public function get_page_title() {
		return $this->page_title;
	}

	/**
	 * @param string $page_title
	 */
	public function set_page_title( $page_title ) {
		$this->page_title = $page_title;
	}

	/**
	 * @return string
	 */
	public function get_menu_title() {
		return $this->menu_title;
	}

	/**
	 * @param string $menu_title
	 */
	public function set_menu_title( $menu_title ) {
		$this->menu_title = $menu_title;
	}

	/**
	 * @return string
	 */
	public function get_capability() {
		return $this->capability;
	}

	/**
	 * @param string $capability
	 */
	public function set_capability( $capability ) {
		$this->capability = $capability;
	}

	/**
	 * @return string
	 */
	public function get_menu_slug() {
		return $this->menu_slug;
	}

	/**
	 * @param string $menu_slug
	 */
	public function set_menu_slug( $menu_slug ) {
		$this->menu_slug = $menu_slug;
	}

	/**
	 * @return string
	 */
	public function get_class() {
		return $this->menu_object;
	}

	/**
	 * @param $menu_object
	 */
	public function set_menu_object( $menu_object ) {
		$this->menu_object = $menu_object;
	}

	/**
	 * @return string
	 */
	public function get_icon_url() {
		return $this->icon_url;
	}

	/**
	 * @param string $icon_url
	 */
	public function set_icon_url( $icon_url ) {
		$this->icon_url = $icon_url;
	}

	/**
	 * @return int
	 */
	public function get_position() {
		return $this->position;
	}

	/**
	 * @param int $postion
	 */
	public function set_position( $position ) {
		$this->position = $position;
	}

	/**
	 * @return bool
	 */
	public function is_sub_menu() {
		return $this->is_sub_menu;
	}

	/**
	 * @param bool $is_sub_menu
	 */
	public function set_is_sub_menu( $is_sub_menu ) {
		$this->is_sub_menu = $is_sub_menu;
	}

	/**
	 * @return string
	 */
	public function get_parent_menu_slug() {
		return $this->parent_menu_slug;
	}

	/**
	 * @param string $parent_menu_slug
	 */
	public function set_parent_menu_slug( $parent_menu_slug ) {
		$this->parent_menu_slug = $parent_menu_slug;
	}
}