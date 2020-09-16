<?php
/*
Plugin Name: Skeleton WordPress Plugin
Description: Accompanying plugin for Skeleton WordPress Theme
Version: 1.0
Author: Mimi Kim
Author URI: https://www.seeyouspacecow.com
*/

namespace SKELETON_PLUGIN;

define( 'SKELETON_PLUGIN_TEXT_DOMAIN', 'skeleton_plugin' );
define( 'SKELETON_PLUGIN_PATH', __FILE__ );

// include files
require_once( 'src/class-setup.php' );

// create instances
new Setup();
