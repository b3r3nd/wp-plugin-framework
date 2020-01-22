<?php

namespace Main\Framework\Loader;


use Main\Framework\Abstracts\Loader_Abstract;

/**
 * Class Shortcode_Loader
 *
 * @package Main\Framework\Loader
 */
class Shortcode_Loader extends Loader_Abstract {

    /**
     * @author Berend de Groot <berend@nugtr.nl>
     */
    public function register_shortcodes() {
        foreach ( $this->loader->shortcodes as $shortcode => $class ) {
            add_shortcode( $shortcode, array( $class, "shortcode" ) );
        }
    }
}