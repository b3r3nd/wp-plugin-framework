<?php

namespace Main\Framework\Loader;

use Main\Framework\Loader;
use Main\Plugin;
use Main\Framework\Options_page;

class Menu_Loader  {
    private $loader;

    /**
     * Menu_Loader constructor.
     * @param $loader
     */
    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
        $this->loader->add_action( "admin_menu", $this, "register_menus" );
    }

    /**
     * Function is called by wordpress (action).
     * @author Berend de Groot <berend@nugtr.nl>
     */
    public function register_menus() {
        if ( Plugin::ALLOWS_MAIN_MENU_PAGE ) {
            $this->register_main_menus($this->loader->menu_pages);
        }
        if ( Plugin::ALLOWS_SUB_MENU_PAGE ) {
            $this->register_sub_menus($this->loader->sub_menu_pages);
        }
        if ( Plugin::ALLOWS_OPTIONS_PAGE ) {
            $this->register_options_page($this->loader->plugin_options);
        }
    }

    /**
     * @param $menu_pages
     * @author Berend de Groot <berend@nugtr.nl>
     */
    public function register_main_menus($menu_pages) {
        foreach ( $menu_pages as $menu_slug => $menu_obj ) {
            add_menu_page( $menu_obj->getPageTitle(), $menu_obj->getMenuTitle(), $menu_obj->getCapability(), $menu_obj->getMenuSlug(), array(
                $menu_obj->getCLass(),
                "menu_page"
            ), $menu_obj->getIconUrl(), $menu_obj->getPostion() );
        }
    }

    /**
     * @param $sub_menu_pages
     * @author Berend de Groot <berend@nugtr.nl>
     */
    public function register_sub_menus($sub_menu_pages) {
        foreach ( $sub_menu_pages as $menu_slug => $menu_obj ) {
            add_submenu_page( $menu_obj->getParentMenuSlug(), $menu_obj->getPageTitle(), $menu_obj->getMenuTitle(), $menu_obj->getCapability(), $menu_obj->getMenuSlug(), array(
                $menu_obj->getCLass(),
                "menu_page"
            ) );
        }
    }

    /**
     * @param $plugin_options
     * @author Berend de Groot <berend@nugtr.nl>
     */
    public function register_options_page($plugin_options) {
        $options_page = new Options_page( $plugin_options );
        add_options_page( Plugin::OPTIONS_PAGE_TITLE, Plugin::OPTIONS_MENU_TITLE, "administrator", Plugin::OPTIONS_MENU_SLUG, array(
            $options_page,
            "menu_page"
        ) );
    }
}