<?php
/**
 * @Author: ComSi
 * @Date: 27-10-17
 * @Time: 17:28
 */

namespace Main\Custom\Menus;
use Main\Framework\Menu_Interface;
use Main\Constants;

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