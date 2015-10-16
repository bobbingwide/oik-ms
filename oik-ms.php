<?php 
/*
Plugin Name: oik-ms
Plugin URI: http://www.oik-plugins.com/oik-plugins/oik-ms
Description: oik multisite shortcode enablement
Version: 0.1  
Author: bobbingwide
Author URI: http://www.bobbingwide.com
License: GPL2


    Copyright 2013 Bobbing Wide (email : herb@bobbingwide.com )

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
 * Implement "oik_loaded" action for oik-ms
 */
function oik_ms_init() {
  bw_add_shortcode( "bw_blog", "bw_blog", oik_path( "shortcodes/oik-blog.php", "oik-ms" ), false ); 
  bw_add_shortcode( "bw_blogs", "bw_blogs", oik_path( "shortcodes/oik-blogs.php", "oik-ms" ), false ); 
  // add_action( "oik_class_intercept", "oik_ms_oik_class_intercept" );
}

/**
 * Implement "oik_class_intercept" action
 *
 * @TODO "oik_class_intercept" is not yet implemented by oik
 */
function oik_ms_oik_blog_intercept( $blog ) {
  if ( $blog ) {
    oik_require( "shortcodes/oik-blog.php", "oik-ms" );
    oik_blog( $blog );
  }  
} 

/**
 * Set the plugin server. Not necessary for a plugin on WordPress.org
 */
function oik_ms_admin_menu() {
  oik_register_plugin_server( __FILE__ );
}

/**
 * Implement "admin_notices" for oik-ms to check plugin dependency
 */ 
function oik_ms_activation() {
  static $plugin_basename = null;
  if ( !$plugin_basename ) {
    $plugin_basename = plugin_basename(__FILE__);
    add_action( "after_plugin_row_" . $plugin_basename, __FUNCTION__ );   
    require_once( "admin/oik-activation.php" );
  }  
  $depends = "oik:2.1-alpha";
  oik_plugin_lazy_activation( __FILE__, $depends, "oik_plugin_plugin_inactive" );
}

/**
 * Function to run when the plugin file is loaded 
 */
function oik_ms_plugin_loaded() {
  add_action( "admin_notices", "oik_ms_activation" );
  //add_action( "oik_admin_menu", "oik_ms_admin_menu" );
  add_action( "oik_loaded", "oik_ms_init" );
}

oik_ms_plugin_loaded();
