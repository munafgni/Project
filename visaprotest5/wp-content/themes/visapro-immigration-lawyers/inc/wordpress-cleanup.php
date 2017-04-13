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
  * Dont Update the Theme
  *
  * If there is a theme in the repo with the same name, this prevents WP from prompting an update.
  *
  * @since  1.0.0
  * @author Bill Erickson
  * @link   http://www.billerickson.net/excluding-theme-from-updates
  * @param  array $r Existing request arguments
  * @param  string $url Request URL
  * @return array Amended request arguments
  */
 function vp_dont_update_theme( $r, $url ) {
 	if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) )
  		return $r; // Not a theme update request. Bail immediately.
  	$themes = json_decode( $r['body']['themes'] );
  	$child = get_option( 'stylesheet' );
 	unset( $themes->themes->$child );
  	$r['body']['themes'] = json_encode( $themes );
  	return $r;
  }
 add_filter( 'http_request_args', 'vp_dont_update_theme', 5, 2 );

/**
 * Header Meta Tags
 *
 */
function vp_header_meta_tags() {
	echo '<meta charset="' . get_bloginfo( 'charset' ) . '">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
	echo '<link rel="profile" href="http://gmpg.org/xfn/11">';
	echo '<link rel="pingback" href="' . get_bloginfo( 'pingback_url' ) . '">';
}
add_action( 'wp_head', 'vp_header_meta_tags' );

/**
 * Clean Nav Menu Classes
 *
 */
function vp_clean_nav_menu_classes( $classes, $item, $args ) {

	if( ! is_array( $classes ) )
		return $classes;

	$allowed_classes = array(
		'menu-item',
		'current-menu-item',
		'current-menu-ancestor',
		'menu-item-has-children',
	);

	return array_intersect( $classes, $allowed_classes );
}
add_filter( 'nav_menu_css_class', 'vp_clean_nav_menu_classes', 5, 3 );

/**
 * Clean Post Classes
 *
 */
function vp_clean_post_classes( $classes ) {

	if( ! is_array( $classes ) )
		return $classes;

    $allowed_classes = array(
  		'hentry',
  		'type-' . get_post_type(),
      'one-half',
      'one-third',
      'two-thirds',
      'one-fourth',
      'two-fourths',
      'three-fourths',
      'one-fifth',
      'two-fifths',
      'three-fifths',
      'four-fifths',
   	);

	return array_intersect( $classes, $allowed_classes );
}
add_filter( 'post_class', 'vp_clean_post_classes', 5 );

/**
 * Remove ancient Custom Fields Metabox because it's slow and most often useless anymore
 * ref: https://core.trac.wordpress.org/ticket/33885
 */
function vp_remove_custom_fields_metabox() {
	foreach ( get_post_types( '', 'names' ) as $post_type ) {
		remove_meta_box( 'postcustom' , $post_type , 'normal' );
	}
}
add_action( 'admin_menu' , 'vp_remove_custom_fields_metabox' );

// Use shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );
