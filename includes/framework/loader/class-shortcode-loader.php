<?php

namespace Main\Framework\Loader;


use Main\Framework\Loader;

class Shortcode_Loader {
    private $loader;

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @author Berend de Groot <berend@nugtr.nl>
     */
    public function register_shortcodes() {
        foreach ( $this->loader->shortcodes as $shortcode => $class ) {
            add_shortcode( $shortcode, array( $class, "shortcode" ) );
        }
    }
}