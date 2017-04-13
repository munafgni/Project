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
 * Body Classes
 *
 */
function vp_archive_body_classes( $classes ) {

	// Blog Archive
	if( is_home() || is_archive() || is_search() ) {
        $classes[] = 'archive';
    }

	$visa_section = vp_visa_section_id();
	if( $visa_section )
		$classes[] = 'visa-section';

	return $classes;
}
add_filter( 'body_class', 'vp_archive_body_classes' );

/**
 * Archive Title, remove prefix
 *
 */
function vp_archive_title_remove_prefix( $title ) {
	$title_pieces = explode( ': ', $title );
	if( count( $title_pieces ) > 1 ) {
		unset( $title_pieces[0] );
		$title = join( ': ', $title_pieces );
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'vp_archive_title_remove_prefix' );

/**
 * Archive Navigation
 *
 */
function vp_archive_navigation() {

	if( ! is_singular() )
		the_posts_pagination( array( 'prev_text' => '<', 'next_text' => '>' ) );

}
add_action( 'tha_content_while_after', 'vp_archive_navigation' );
