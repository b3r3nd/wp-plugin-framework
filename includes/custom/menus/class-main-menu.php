<?php

namespace Main\Custom\Menus;

use Main\Framework\Menu_Interface;

/**
 * Class Main_Menu
 *
 * @package Main\Custom\Menus
 */
class Main_Menu implements Menu_Interface {
	public function menu_page() {
		?>
        Main menu
		<?php
	}
}