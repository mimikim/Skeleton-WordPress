<?php
/**
 * Example of creating custom post type
 */

namespace SKELETON_PLUGIN\POST_TYPE;

defined( 'ABSPATH' ) or die( 'File cannot be accessed directly' );

class Post_Type_Demo extends Post_Type {

    public function register_custom_post_type() {
        $labels = array(
            'singular' => 'Example',
            'plural' => 'Examples',
            'slug' => 'example'
        );

        $args = array(
            'show_in_rest'  => true,
            'menu_position' => 20, // below Pages
            'menu_icon'     => 'dashicons-admin-site',
        );

        $this->register_post_type( $labels, $args );
    }

}
