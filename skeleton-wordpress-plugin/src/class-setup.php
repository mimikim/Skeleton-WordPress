<?php
/**
 * Handles set up of plugin
 */

namespace SKELETON_PLUGIN;

defined( 'ABSPATH' ) or die( 'File cannot be accessed directly' );

require_once( 'post-types/class-post-type.php' );
require_once( 'post-types/class-post-type-demo.php' );
require_once( 'taxonomies/class-taxonomies.php' );
require_once( 'taxonomies/class-example-taxonomy.php' );
require_once( 'widgets/class-widgets.php' );
require_once( 'widgets/class-widget-woocommerce.php' );

class Setup {
    public function __construct() {
        $this->create_instances();
    }

    // class instances
    public function create_instances() {
        new WIDGETS\Widgets();

        // extending a base class
        new POST_TYPE\Post_Type();
        new POST_TYPE\Post_Type_Demo();
        new TAXONOMIES\Example_Taxonomy();
    }

}
