<?php

namespace Main\Custom\Shortcodes;

use Main\Framework\Shortcode_Interface;

/**
 * First Example Shortcode.
 *
 * @author Berend de Groot <berend@nugtr.nl>
 */
class Example_Shortcode implements Shortcode_Interface {
	/**
	 * @param $attrs
	 *
	 * @return string
	 */
	public function shortcode( $attrs ) {
		ob_start(); ?>

        Example Shortcode.

		<?php return ob_get_clean();
	}
}