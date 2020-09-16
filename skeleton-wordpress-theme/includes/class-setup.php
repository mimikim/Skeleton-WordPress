<?php
/**
 * Enqueues scripts and stylesheets
 * Enables theme supports
 */

namespace SKELETON;

defined( 'ABSPATH' ) or die( 'File cannot be accessed directly' );

class Setup {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 999);
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 999);
        add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
    }

    // enqueue css stylesheets
    public function enqueue_styles() {
        wp_enqueue_style( 'main-css', get_template_directory_uri() . '/assets/css/style.min.css', [], null, 'all' );
    }

    // enqueue javascript files
    public function enqueue_scripts() {
        wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/scripts.min.js', array( 'jquery' ), null, true );
    }

    // enabling wordpress features
    public function theme_supports() {
        set_post_thumbnail_size(125, 125, true);

        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'html5',
            array(
                'search-form',
            )
        );

    }

}
