<?php

namespace Main\Framework\Classes;
/**
 * Class Menu
 *
 * @package Main\Framework\Entities
 */
class Menu {
	private $page_title;
	private $menu_title;
	private $capability;
	private $menu_slug;
	private $menu_object;
	private $icon_url;
	private $postion;
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
	 * @param string $icon_url
	 * @param int    $postion
	 * @param bool   $is_sub_menu
	 * @param string $parent_menu_slug
	 */
	function __construct( $page_title = "", $menu_title = "", $capability = "", $menu_slug = "", $menu_object, $icon_url, $postion, $is_sub_menu = false, $parent_menu_slug = "" ) {
		$this->page_title       = $page_title;
		$this->menu_title       = $menu_title;
		$this->capability       = $capability;
		$this->menu_slug        = $menu_slug;
		$this->menu_object      = $menu_object;
		$this->icon_url         = $icon_url;
		$this->postion          = $postion;
		$this->is_sub_menu      = $is_sub_menu;
		$this->parent_menu_slug = $parent_menu_slug;
	}

	/**
	 * @return string
	 */
	public function getPageTitle() {
		return $this->page_title;
	}

	/**
	 * @param string $page_title
	 */
	public function setPageTitle( $page_title ) {
		$this->page_title = $page_title;
	}

	/**
	 * @return string
	 */
	public function getMenuTitle() {
		return $this->menu_title;
	}

	/**
	 * @param string $menu_title
	 */
	public function setMenuTitle( $menu_title ) {
		$this->menu_title = $menu_title;
	}

	/**
	 * @return string
	 */
	public function getCapability() {
		return $this->capability;
	}

	/**
	 * @param string $capability
	 */
	public function setCapability( $capability ) {
		$this->capability = $capability;
	}

	/**
	 * @return string
	 */
	public function getMenuSlug() {
		return $this->menu_slug;
	}

	/**
	 * @param string $menu_slug
	 */
	public function setMenuSlug( $menu_slug ) {
		$this->menu_slug = $menu_slug;
	}

	/**
	 * @return string
	 */
	public function getCLass() {
		return $this->menu_object;
	}

	/**
	 * @param $menu_object
	 */
	public function setMenuobject( $menu_object ) {
		$this->menu_object = $menu_object;
	}

	/**
	 * @return string
	 */
	public function getIconUrl() {
		return $this->icon_url;
	}

	/**
	 * @param string $icon_url
	 */
	public function setIconUrl( $icon_url ) {
		$this->icon_url = $icon_url;
	}

	/**
	 * @return int
	 */
	public function getPostion() {
		return $this->postion;
	}

	/**
	 * @param int $postion
	 */
	public function setPostion( $postion ) {
		$this->postion = $postion;
	}

	/**
	 * @return bool
	 */
	public function isIsSubMenu() {
		return $this->is_sub_menu;
	}

	/**
	 * @param bool $is_sub_menu
	 */
	public function setIsSubMenu( $is_sub_menu ) {
		$this->is_sub_menu = $is_sub_menu;
	}

	/**
	 * @return string
	 */
	public function getParentMenuSlug() {
		return $this->parent_menu_slug;
	}

	/**
	 * @param string $parent_menu_slug
	 */
	public function setParentMenuSlug( $parent_menu_slug ) {
		$this->parent_menu_slug = $parent_menu_slug;
	}
}