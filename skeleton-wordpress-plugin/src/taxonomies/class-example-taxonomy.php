<?php
/**
 * Example of extending taxonomy class
 * Plus showcasing additional methods specific for this taxonomy
 */

namespace SKELETON_PLUGIN\TAXONOMIES;

defined( 'ABSPATH' ) or die( 'File cannot be accessed directly' );

class Example_Taxonomy extends Taxonomies {

    public function init() {
        add_action( 'init', array( $this, 'register_custom_taxonomy' ) );
        add_action( 'init', array( $this, 'add_default_terms' ) );
    }

    public function register_custom_taxonomy() {
        $labels = array(
            'object_type' => array( 'example' ),
            'plural'      => 'Example Taxonomies',
            'singular'    => 'Example Taxonomy',
            'slug'        => 'example-taxonomy'
        );

        $args = array(
            'hierarchical'  => true
        );

        $this->register_taxonomy( $labels, $args );
    }

    // inserts some predefined taxonomy terms, if empty
    public function add_default_terms() {
        $taxonomy = get_terms( 'example-taxonomy', array( 'hide_empty' => false ) );

        if ( empty( $taxonomy ) ) {
            $predefined_terms = $this->return_taxonomy_terms();

            foreach ( $predefined_terms as $term ) {
                if ( ! term_exists( $term['name'], 'example-taxonomy' ) ) {
                    wp_insert_term( $term['name'], 'example-taxonomy', array( 'slug' => $term['code'] ) );
                }
            }

        }
    }

    // returns array of predefined terms
    private function return_taxonomy_terms() {
        return array(
            '0' => array(
                'name' => 'Red',
                'code' => 'red',
            ),
            '1' => array(
                'name' => 'Orange',
                'code' => 'orange',
            ),
            '2' => array(
                'name' => 'Yellow',
                'code' => 'yellow',
            ),
            '3' => array(
                'name' => 'Green',
                'code' => 'green',
            ),
            '4' => array(
                'name' => 'Blue',
                'code' => 'blue',
            ),
            '5' => array(
                'name' => 'Purple',
                'code' => 'purple',
            ),
        );
    }

}
