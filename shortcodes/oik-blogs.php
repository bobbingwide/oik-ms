<?php // (C) Copyright Bobbing Wide 2013-2015

/**
 * List blogs in a WordPress MultiSite environment 
 * 
 * This reinstates part of the deprecated get_blog_list() function for use with oik-ms
 * Notes: 
 * - oik-ms should only be installed in a WPMS environment where you are happy for other sites and their content to be accessed
 * - There is no security in this code over and above the existing WordPress MS security
 * - DON'T use this function in a large WPMS installation as the list can be very large
 * 
 * Alternative function NOT used: 
 * $wp_list_table = _get_list_table( 'WP_MS_Sites_List_Table' );
 * 
 * @return mixed - array of arrays [ "blog_id" 
 */
function bw_get_blog_list() {
	global $wpdb;
	$blogs = array();
	$results = $wpdb->get_results( $wpdb->prepare("SELECT blog_id FROM $wpdb->blogs WHERE site_id = %d AND public = '1' AND archived = '0' AND mature = '0' AND spam = '0' AND deleted = '0' ORDER BY blog_id ASC", $wpdb->siteid), ARRAY_A );
	foreach ( $results as $key => $data ) {
		$blog_id = $data['blog_id'];
		$blogs[$blog_id ] = $blog_id;
	}  
	//bw_trace2( $blogs, "blogs", false, BW_TRACE_DEBUG );
	return( $blogs );
} 

/**
 * Display information about each blog in the array of blogs
 *
 * @param	array $blogs
 * @param array $atts - shortcode attributes
 * @param string $content - content to be displayed for each blog
 */
function bw_display_blogs( $blogs, $atts, $content ) {
	$class = bw_array_get( $atts, "class", null );
	foreach ( $blogs as $blog ) {
		sdiv( "bw_blog $class" );
		bw_display_blog( $blog, $atts, $content );
		ediv( "bw_blog" );
	}  
}

/**
 * Get all blog details - whether by ID or blog name
 * 
 * `
 (
    [blog_id] => 1
    [site_id] => 1
    [domain] => qw
    [path] => /wpms/
    [registered] => 2012-01-08 15:28:21
    [last_updated] => 2013-09-10 13:14:08
    [public] => 1
    [archived] => 0
    [mature] => 0
    [spam] => 0
    [deleted] => 0
    [lang_id] => 0
    [blogname] => WordPress Multi Site
    [siteurl] => http://qw/wpms
    [post_count] => 6
)
	 `
 * 
 * @param $blog - blog ID or blog name or array of fields
 * @return mixed - $bloginfo
 */
function bw_get_bloginfo( $blog ) {
	$bloginfo = get_blog_details( $blog );
	//bw_trace2( $bloginfo, "bloginfo", false, BW_TRACE_DEBUG ); 
	return( $bloginfo );
}

/**
 * Display a blog option or shortcode
 * 
 */
function bw_display_blog_field( $shortcode, $tag="div", $use_shortcode=true ) {
	stag( $tag );
	if ( $use_shortcode ) {
		e( do_shortcode( "[$shortcode]" ) );
	} else {
		bw_get_option( $shortcode );
		e( $shortcode );
	}  
	etag( "e$tag" );
}

/**
 * Display information about a blog in a particular format
 *
 * 
 */
function bw_display_blog( $id, $atts, $content ) {
	$bloginfo = bw_get_bloginfo( $id );
	if ( $bloginfo ) {
		if ( is_numeric( $id ) ) {
			$url = get_blogaddress_by_id( $id );
		} else { 
			$url = get_blogaddress_by_name( $id );
		}
		$blog = $bloginfo->blog_id;
		
		switch_to_blog( $blog );
		if ( $content ) {
			e( bw_do_shortcode( $content ) );
		} else {
			alink( null, $url, $bloginfo->blogname );
		}
		restore_current_blog();
	}
}

/** 
 * Implement [bw_blogs] shortcode to list the blogs on the multisite
 * 
 * @param array $atts - expected to either contain "blogs" or uses the index 0 values
 * @param string $content - content to expand for each blog
 * @param string $tag - the shortcode used
 * @return string - nothing is generated directly by this shortcode
 */
function bw_blogs( $atts=null, $content=null, $tag=null )  {
	if ( is_multisite() ) {
		$blogs = bw_array_get_from( $atts, "blogs,0", null );
		if ( $blogs ) {
		 $blogs = bw_as_array( $blogs );
		} else {
			$blogs = bw_get_blog_list();
		}
		bw_display_blogs( $blogs, $atts, $content );
	} else { 
		bw_trace2( "bw_blogs shortcode not effective in a non-multisite implementation" );
	}  
	return( bw_ret() );
}

/**
 * Help hook for "bw_blogs" shortcode
 */
function bw_blogs__help( $shortcode="bw_blogs" ) {
	return( "List blogs or display content for selected blogs" );
}

/**
 * Syntax hook for "bw_blogs" shortcode
 */
function bw_blogs__syntax( $shortcode="bw_blogs" ) {
	$syntax = array( "blogs" => bw_skv( null, "<i>blog,blog</i>", "numeric IDs/names of blogs to be listed" ) 
								 );
	return( $syntax );
}  
  



