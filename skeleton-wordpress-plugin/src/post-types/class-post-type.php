<?php
/**
 * Base class for registering custom post types
 */

namespace SKELETON_PLUGIN\POST_TYPE;

defined( 'ABSPATH' ) or die( 'File cannot be accessed directly' );

class Post_Type {

    public function __construct() {
        $this->init();
    }

    public function init() {
        add_action( 'init', array( $this, 'register_custom_post_type' ) );
    }

    /**
     * base "register post-type" function
     * when registering a post type, use this function
     * @param array $data : arguments for labels
     * @param array $custom_args : custom array to override default $args array
     */
    public function register_post_type( $data, $custom_args = [] ) {
        $labels = array(
            'name'               => _x( $data['plural'], 'post type general name', SKELETON_PLUGIN_TEXT_DOMAIN ),
            'singular_name'      => _x( $data['singular'], 'post type singular name', SKELETON_PLUGIN_TEXT_DOMAIN ),
            'menu_name'          => _x( $data['plural'], 'admin menu', SKELETON_PLUGIN_TEXT_DOMAIN ),
            'name_admin_bar'     => _x( $data['singular'], 'add new on admin bar', SKELETON_PLUGIN_TEXT_DOMAIN ),
            'add_new'            => _x( 'Add New ' . $data['singular'], $data['slug'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'add_new_item'       => __( 'Add New ' . $data['singular'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'new_item'           => __( 'New ' . $data['singular'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'edit_item'          => __( 'Edit ' . $data['singular'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'view_item'          => __( 'View ' . $data['singular'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'all_items'          => __( 'All ' . $data['plural'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'search_items'       => __( 'Search ' . $data['plural'] . ':', SKELETON_PLUGIN_TEXT_DOMAIN ),
            'parent'             => __( 'Parent ' . $data['singular'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'parent_item_colon'  => __( 'Parent ' . $data['plural'], SKELETON_PLUGIN_TEXT_DOMAIN ),
            'not_found'          => __( 'No ' . $data['plural'] . ' found.', SKELETON_PLUGIN_TEXT_DOMAIN ),
            'not_found_in_trash' => __( 'No ' . $data['plural'] . ' found in Trash.', SKELETON_PLUGIN_TEXT_DOMAIN )
        );

        $args = array(
            'capability_type'    => 'post',
            'description'        => '',
            'has_archive'        => true,
            'hierarchical'       => false,
            'labels'             => $labels,
            'menu_position'      => null,
            'public'             => true,
            'publicly_queryable' => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => $data['slug'] ),
            'show_ui'            => true,
            'show_in_menu'       => true,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'revisions', 'excerpt' ),
            'taxonomies'         => array()
        );

        // if $custom_args exists, replace $args array with values from $custom_args
        if ( ! empty( $custom_args ) ) {
            $args = array_replace( $args, $custom_args );
        }

        register_post_type( $data['slug'], $args );
    }

    // creating custom post type
    public function register_custom_post_type() {
        $labels = array();
        $args = array();

        $this->register_post_type( $labels, $args );
    }

}