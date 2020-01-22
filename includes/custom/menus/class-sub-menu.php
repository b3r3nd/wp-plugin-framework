<?php

namespace Main\Custom\Menus;

use Main\Framework\Menu_Interface;

/**
 * Class Sub_Menu
 *
 * @package Main\Custom\Menus
 * @author Berend de Groot <berend@nugtr.nl>
 */
class Sub_Menu implements Menu_Interface {
	public function menu_page() {
		echo "Sub menu";
	}
}