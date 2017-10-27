<?php
namespace PT_Shortcodes;
/**
 * First Example Shortcode.
 *
 * @why As example
 * @usedFor a test page
 */
class Example_Shortcode {
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