<?php
/**
 * Register Sidebars
 */

namespace SKELETON;

defined( 'ABSPATH' ) or die( 'File cannot be accessed directly' );

class Sidebars {

    public function __construct() {
        add_action( 'widgets_init', array( $this, 'register_sidebars' ) );
    }

    public function register_sidebars() {
        register_sidebar( array(
            'id' => 'main-sidebar',
            'name' => __('Main Sidebar', TEXT_DOMAIN ),
            'description' => __('The Main Sidebar', TEXT_DOMAIN ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widgettitle">',
            'after_title' => '</h4>',
        ) );
    }

}
