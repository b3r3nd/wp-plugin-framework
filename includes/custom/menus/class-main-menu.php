<?php

namespace Main\Custom\Menus;

use Main\Framework\Menu_Interface;

/**
 * Class Main_Menu
 *
 * @package Main\Custom\Menus
 * @author Berend de Groot <berend@nugtr.nl>
 */
class Main_Menu implements Menu_Interface {
	public function menu_page() {
		?>
        Main menu
		<?php
	}
}