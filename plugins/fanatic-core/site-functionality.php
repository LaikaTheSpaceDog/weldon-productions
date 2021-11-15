<?php

/*
Plugin Name: Fanatic Core
Plugin URI: http://fanaticdesign.co.uk/
Description: Essentials for functionality of the website
Author: The Fanatic team
Author URI: http://fanaticdesign.co.uk/
Version: 2.0
*/

if ( !function_exists('do_action') ) {
	exit();
}

// Include your required data types
require_once( plugin_dir_path( __FILE__ ) . 'includes/meta.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/post-types.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/taxonomy.php');

// Helper functions
foreach (glob(plugin_dir_path( __FILE__ ) . "includes/functions/*.php") as $filename) {
  require_once $filename;
}

// Shortcode functions
//foreach (glob(plugin_dir_path( __FILE__ ) . "includes/shortcodes/*.php") as $filename) {
//  require_once $filename;
//}
