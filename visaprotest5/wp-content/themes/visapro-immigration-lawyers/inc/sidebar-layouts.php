<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

 /**
  * Layout Body Class
  *
  */
function vp_layout_body_class( $classes ) {

  $classes[] = vp_page_layout();
  return $classes;
}
add_filter( 'body_class', 'vp_layout_body_class', 5 );

 /**
  * Page Layout
  *
  */
 function vp_page_layout() {

 	$available_layouts = array( 'full-width-content', 'content-sidebar', 'sidebar-content' );
 	$layout = 'full-width-content';

 	$layout = apply_filters( 'vp_page_layout', $layout );
 	$layout = in_array( $layout, $available_layouts ) ? $layout : $available_layouts[0];

 	return sanitize_title_with_dashes( $layout );
 }

 /**
  * Return Full Width Content
  * used when filtering 'vp_page_layout'
  */
 function vp_return_full_width_content() {
 	return 'full-width-content';
 }

 /**
  * Return Content Sidebar
  * used when filtering 'vp_page_layout'
  */
 function vp_return_content_sidebar() {
 	return 'content-sidebar';
 }

 /**
  * Return Sidebar Content
  * used when filtering 'vp_page_layout'
  */
 function vp_return_sidebar_content() {
 	return 'sidebar-content';
 }

 /**
  * Wide Content
  *
  */
 function vp_wide_content( $classes ) {
     $classes[] = 'wide-content';
     return $classes;
 }

/**
 * Medium Content
 *
 */
function vp_medium_content( $classes ) {
    $classes[] = 'medium-content';
    return $classes;
}
