<?php 
/*
Plugin Name: oik-ms
Plugin URI: https://www.oik-plugins.com/oik-plugins/oik-ms
Description: oik multisite shortcodes
Version: 0.2.2
Author: bobbingwide
Author URI: https://bobbingwide.com/about-bobbing-wide
Text Domain: oik-ms
Domain Path: /languages/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

    Copyright 2013-2015, 2023 Bobbing Wide (email : herb@bobbingwide.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License version 2,
    as published by the Free Software Foundation.

    You may NOT assume that you can use any other version of the GPL.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    The license for this software can likely be found here:
    http://www.gnu.org/licenses/gpl-2.0.html

*/

/**
 * Implement "oik_add_shortcodes" action for oik-ms
 */
function oik_ms_init() {
  bw_add_shortcode( "bw_blog", "bw_blog", oik_path( "shortcodes/oik-blog.php", "oik-ms" ), false ); 
  bw_add_shortcode( "bw_blogs", "bw_blogs", oik_path( "shortcodes/oik-blogs.php", "oik-ms" ), false ); 
}

/**
 * 
 * Implement "oik_admin_menu" action for oik-ms
 *
 * Set the plugin server. Not necessary for a plugin on WordPress.org
 * Load the oik-ms admin logic
 */
function oik_ms_admin_menu() {
  oik_register_plugin_server( __FILE__ );
  oik_require( "admin/oik-ms.php", "oik-ms" );
  oik_ms_lazy_admin_menu();
}

/**
 * Implement "admin_notices" for oik-ms to check plugin dependency
 */ 
function oik_ms_activation() {
  static $plugin_basename = null;
  if ( !$plugin_basename ) {
    $plugin_basename = plugin_basename(__FILE__);
    add_action( "after_plugin_row_oik-ms/oik-ms.php", "oik_ms_activation" ); 
    if ( !function_exists( "oik_plugin_lazy_activation" ) ) { 
      require_once( "admin/oik-activation.php" );
    }
  }  
  $depends = "oik:2.5";
  oik_plugin_lazy_activation( __FILE__, $depends, "oik_plugin_plugin_inactive" );
}

/**
 * Function to run when the plugin file is loaded 
 */
function oik_ms_plugin_loaded() {
  add_action( "admin_notices", "oik_ms_activation" );
  add_action( "oik_admin_menu", "oik_ms_admin_menu" );
  add_action( "oik_add_shortcodes", "oik_ms_init" );
	//add_action( "oik_fields_loaded", "oik_ms_oik_fields_loaded" );
}

oik_ms_plugin_loaded();