<?php

namespace Main\Custom\Menus;

use Main\Framework\Menu_Interface;

/**
 * Class Sub_Menu
 *
 * @package Main\Custom\Menus
 */
class Sub_Menu implements Menu_Interface {
	public function menu_page() {
		echo "Sub menu";
	}
}