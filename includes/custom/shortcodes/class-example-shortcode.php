<?php

namespace Main\Custom\Shortcodes;

use Main\Framework\Shortcode_Interface;

/**
 * First Example Shortcode.
 *
 * @why As example
 * @usedFor a test page
 */
class Example_ShortcodeInterface implements Shortcode_Interface {
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