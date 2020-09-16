<?php
/**
 * Registers custom widgets
 * Widgets are defined within the /widgets/ folder
 */

namespace SKELETON_PLUGIN\WIDGETS;

defined( 'ABSPATH' ) or die( 'File cannot be accessed directly' );

class Widgets {

    public function __construct() {
        add_action( 'widgets_init', array( $this, 'load_custom_widgets' ) );
    }

    public function load_custom_widgets() {
        // woocommerce-specific widget
        if ( class_exists( 'woocommerce' ) ) {
            register_widget( new Widget_Woocommerce() );
        }
    }
}
