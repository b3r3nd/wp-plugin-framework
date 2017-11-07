<?php
/**
 * @Author: ComSi
 * @Date: 27-10-17
 * @Time: 17:43
 */

namespace Main\Custom\Menus;
use Main\Framework\Menu_Interface;

class Sub_Menu implements Menu_Interface {
	public function menu_page() {
		echo "Sub menu";
	}
}