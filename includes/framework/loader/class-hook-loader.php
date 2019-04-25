<?php

namespace Main\Framework\Loader;

use Main\Plugin;
use Main\Framework\Loader;

class Hook_loader {
    private $loader;

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @author Berend de Groot <berend@nugtr.nl>
     */
    public function register_filters() {
        foreach ( $this->loader->filters as $hook ) {
            add_filter( $hook['hook'], array(
                $hook['component'],
                $hook['callback']
            ), $hook['priority'], $hook['accepted_args'] );
        }
    }

    /**
     * @author Berend de Groot <berend@nugtr.nl>
     */
    public function register_actions() {
        foreach ( $this->loader->actions as $hook ) {
            add_action( $hook['hook'], array(
                $hook['component'],
                $hook['callback']
            ), $hook['priority'], $hook['accepted_args'] );
        }
        if ( Plugin::ALLOWS_META_BOXES ) {
            $this->register_meta_boxes();
        }
    }
}