<?php

namespace SKELETON;

define( 'TEXT_DOMAIN', 'skeleton_theme' );

require_once( get_template_directory() . '/includes/class-setup.php' );
require_once( get_template_directory() . '/includes/class-menus.php' );
require_once( get_template_directory() . '/includes/class-sidebars.php' );

new Setup();
new Menus();
new Sidebars();
