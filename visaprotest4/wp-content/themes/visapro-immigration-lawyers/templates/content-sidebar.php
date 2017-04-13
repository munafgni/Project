<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Content Sidebar */

// Content Sidebar layout
add_filter( 'vp_page_layout', 'vp_return_content_sidebar' );

/**
 * Content Style
 *
 */
function vp_content_sidebar_style( $classes ) {
    $classes[] = esc_attr( 'style-' . vp_cf( 'vp_content_width' ) );
    return $classes;
}
add_filter( 'body_class', 'vp_content_sidebar_style' );

/**
 * Page Header
 *
 */
function vp_cs_page_header() {
    echo '<div class="page-header">';
    vp_entry_title();
    vp_entry_subtitle();
    vp_entry_header_text();
    echo '</div>';
}
add_action( 'tha_content_before', 'vp_cs_page_header' );
remove_action( 'tha_entry_top', 'vp_entry_title' );
remove_action( 'tha_entry_top', 'vp_entry_subtitle', 12 );
remove_action( 'tha_entry_top', 'vp_entry_header_text', 13 );

/**
 * Sidebar
 *
 */
function vp_cs_sidebar(){
    echo apply_filters( 'vp_the_content', vp_cf( 'vp_sidebar' ) );
}
add_action( 'tha_sidebar_top', 'vp_cs_sidebar' );

// Build the page
require get_template_directory() . '/index.php';
