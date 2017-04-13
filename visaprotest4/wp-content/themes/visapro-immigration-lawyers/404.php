<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

// Content Sidebar layout
add_filter( 'vp_page_layout', 'vp_return_content_sidebar' );

// Remove Breadcrumbs
remove_action( 'tha_header_after', 'vp_breadcrumbs' );


/**
 * Content Style
 *
 */
function vp_404_style( $classes ) {
    $classes[] = 'page-template-content-sidebar';
    $classes[] = 'style-narrow';
    return $classes;
}
add_filter( 'body_class', 'vp_404_style' );

/**
 * Page Header
 *
 */
function vp_404_page_header() {
    echo '<div class="page-header">';
    echo '<h1 class="entry-title">404: Sorry, we can’t find the page you’re looking for</h1>';
    echo '</div>';
}
add_action( 'tha_content_before', 'vp_404_page_header' );

/**
 * Sidebar
 *
 */
function vp_404_sidebar(){
    echo apply_filters( 'vp_the_content', vp_cf( 'vp_sidebar', 53 ) );
}
add_action( 'tha_sidebar_top', 'vp_404_sidebar' );

/**
 * Sitemap
 *
 */
function vp_404_sitemap() {

    echo '<div class="sitemap"><div class="wrap">';
    echo '<hr />';
    echo apply_filters( 'vp_the_content', get_post( 61 )->post_content );
    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_404_sitemap', 5 );

// Build the page
require get_template_directory() . '/index.php';
