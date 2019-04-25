<?php
namespace Main\Framework\Loader;

use Main\Framework\Loader;
use Main\Plugin;

class Options_Loader {
    private $loader;

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @author Berend de Groot <berend@nugtr.nl>
     */
    public function register_plugin_options() {
        foreach ( $this->loader->plugin_options as $plugin_setting ) {
            register_setting( Plugin::OPTIONS_GROUP, $plugin_setting->getName() );
        }
    }
}