<?php // (C) Copyright Bobbing Wide 2013

/**
 * Implements "oik_admin_menu" action for oik-ms
 *
 * Adds the actions and filters needed to allow oik options to be defined for individual sites
 *
 */
function oik_ms_lazy_admin_menu() {
  add_action( "oik_menu_box", "oik_ms_menu_box" );
}

/**
 * Implement "oik_menu_box" action for oik-ms
 */
function oik_ms_menu_box() {
  oik_box( NULL, NULL, "oik multi-site settings", "oik_ms_settings" );
}

/** 
 * Display/process the Copy options form
 */
function oik_ms_settings() {
  p( "Use this form to copy oik options values from a site of your choice." );
  p( "You should only need to do this once per new site." );
  oik_ms_copy_site_settings();
  bw_form();
  stag( "table", "widefat" );
  $sites = oik_ms_site_list();
  bw_select( "oik_ms_site", "Source site", null, array( "#options" =>  $sites ) );
  $alts = array( 0 => "options"
               , 1 => "more options (alt=1)"
               , 2 => "more options 2 ( alt=2)" 
               ); 
  bw_select( "oik_ms_alt_source", "Source options set", null, array( "#options" => $alts ) );
  bw_select( "oik_ms_alt_target", "Target options set", null, array( "#options" => $alts ) );
  etag( "table" );
  p( isubmit( "_oik_ms_copy_options", "Copy options from site", null, "button-secondary" ) );
  etag( "form" );
}

/**
 * Return an array of sites 
 */
function oik_ms_site_list() {
  oik_require( "shortcodes/oik-blogs.php", "oik-ms" );
  $blogs = bw_get_blog_list();
  $site_select = array();
  foreach ( $blogs as $blog ) {
    $bloginfo = bw_get_bloginfo( $blog );
    $site_select[ $blog ] = $bloginfo->blogname; 
  }
  return( $site_select );
}


/**
 * Handle Copy options form
 */
function oik_ms_copy_site_settings() {
  $copy = bw_array_get( $_REQUEST, "_oik_ms_copy_options", null );
  if ( $copy ) {
    $alt_source = bw_array_get( $_REQUEST, "oik_ms_alt_source", null );
    $alt_target = bw_array_get( $_REQUEST, "oik_ms_alt_target", null );
    $site_id = bw_array_get( $_REQUEST, "oik_ms_site", null );
    if ( $site_id && $alt_source != null && $alt_target != null ) {
      oik_ms_copy_settings_to_site( $alt_source, $alt_target, $site_id );
    } else {
      p( "Please choose source site and source and target options" );
      p( "site=$site_id" );
      p( "alt source=$alt_source" );
      p( "alt target=$alt_target" );
    }
  }
}

/**
 * Copy settings from the source site to the target site... the current site
 */
function oik_ms_copy_settings_to_site( $alt_source, $alt_target, $site_id ) {
  p( "Copying settings from $site_id. Source $alt_source, target $alt_target" );
  $sets = array ( "bw_options" 
                , "bw_options1"
                , "bw_options2" 
                );
  switch_to_blog( $site_id );
  $new_options = get_option( $sets[ $alt_source ] );
  restore_current_blog();
  update_option( $sets[ $alt_target ], $new_options );
}
