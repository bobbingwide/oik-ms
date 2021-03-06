<?php // (C) Copyright Bobbing Wide 2013-2015

/** 
 * Implement [bw_blog] shortcode to select the blog to be used in subsequent shortcodes
 *
 * We might eexpect that if the blog was invalid then switch_to_blog() would fail.
 * But it doesn't, so we need to check.
 * 
 * 
 * @param array $atts - expected to either contain "blog" or uses the index 0 values
 * @param string $content - not expected
 * @param string $tag - the shortcode used
 * @return string - nothing is generated directly by this shortcode
 */
function bw_blog( $atts=null, $content=null, $tag=null )  {
  if ( is_multisite() ) {
    $blog = bw_array_get_from( $atts, "blog,0", null );
    if ( $blog ) {
		  $details = get_blog_details( $blog, false );
			if ( $details ) {
				switch_to_blog( $blog );
			} else {
			  e( "Invalid blog $blog" );
			}
    } else {
      restore_current_blog();
    }   
  } else { 
    bw_trace2( "Shortcode not effective in a non-multisite implementation" );
  }  
  return( bw_ret() );
}

/**
 * Help hook for "bw_blog" shortcode
 */
function bw_blog__help( $shortcode="bw_blog" ) {
  return( "Select blog to process" );
}

/**
 * Syntax hook for "bw_blog" shortcode
 */
function bw_blog__syntax( $shortcode="bw_blog" ) {
  $syntax = array( "blog" => bw_skv( null, "<i>blog ID</i>", "numeric ID of blog to be selected" ) 
                 );
  return( $syntax );
}  

/**
 *
 */
 
  



