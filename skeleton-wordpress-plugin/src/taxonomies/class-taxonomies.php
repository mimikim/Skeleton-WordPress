<?php
/**
 * Base class for registering taxonomies
 */

namespace SKELETON_PLUGIN\TAXONOMIES;

defined( 'ABSPATH' ) or die( 'File cannot be accessed directly' );

class Taxonomies {

    public function __construct() {
        $this->init();
    }

    // init function
    public function init() {
        add_action( 'init', array( $this, 'register_custom_taxonomy' ) );
    }

    /**
     * base "register taxonomy" function
     * when registering a taxonomy, use this function
     * @param array $data : arguments for labels
     * @param array $custom_args : custom array to override default $args array
     */
    public function register_taxonomy( $data, $custom_args = [] ) {
        $labels = array(
            'name'              => _x( $data['plural'], 'taxonomy general name', SKELETON_PLUGIN_TEXT_DOMAIN ),
            'singular_name'     => _x( $data['singular'], 'taxonomy singular name', SKELETON_PLUGIN_TEXT_DOMAIN ),
            'search_items'      => __( 'Search ' . $data['plural'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'all_items'         => __( 'All ' . $data['plural'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'parent_item'       => __( 'Parent ' . $data['singular'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'parent_item_colon' => __( 'Parent ' . $data['singular'] . ':', SKELETON_PLUGIN_TEXT_DOMAIN ),
            'edit_item'         => __( 'Edit ' . $data['singular'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'update_item'       => __( 'Update ' . $data['singular'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'add_new_item'      => __( 'Add New ' . $data['singular'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'new_item_name'     => __( 'New ' . $data['singular'] .' Name', SKELETON_PLUGIN_TEXT_DOMAIN ),
        );

        $args = array(
            'description'       => '',
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_in_rest'      => true,
            'public'            => true,
            'show_admin_column' => true,
        );

        // if $custom_args exists, replace $args array with values from $custom_args
        if ( ! empty( $custom_args ) ) {
            $args = array_replace( $args, $custom_args );
        }

        register_taxonomy( $data['slug'], $data['object_type'], $args );
    }

    // add custom arguments for taxonomy
    public function register_custom_taxonomy() {
        $labels = array();
        $args = array();
        $this->register_taxonomy( $labels, $args );
    }

}
