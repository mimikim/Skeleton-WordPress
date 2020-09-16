<?php
/**
 * Registers menus
 */

namespace SKELETON;

defined( 'ABSPATH' ) or die( 'File cannot be accessed directly' );

class Menus {

    public function __construct() {
        $this->register_menus();
    }

    public function register_menus() {
        register_nav_menus( array(
            'main-nav' => __( 'The Main Menu', TEXT_DOMAIN ),
        ) );
    }

    // static function to return menu
    public static function display_main_nav() {
        wp_nav_menu( array(
            'container'      => false,
            'menu_id'        => 'main-nav',
            'menu_class'     => 'nav-menu',
            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'theme_location' => 'main-nav',
            'depth'          => 5,
            'fallback_cb'    => false,
        ) );
    }
}
