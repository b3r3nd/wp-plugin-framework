<?php

namespace Main\Framework;
/**
 * Interface Shortcode_Interface
 *
 * This interface needs to be implemented to custom added shortcodes, so the function can be called.
 *
 * @package Main\Framework
 * @author  Berend de Groot <berend@nugtr.nl>
 */
interface Shortcode_Interface {
	public function shortcode( $attrs );
}