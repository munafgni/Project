<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Refer a Friend */

// Content Sidebar layout
add_filter( 'vp_page_layout', 'vp_return_content_sidebar' );

/**
 * Refer Page Header
 *
 */
function vp_refer_page_header() {
    echo '<div class="page-header">';
    vp_entry_title();
    vp_entry_subtitle();
    vp_entry_header_text();
    echo '</div>';
}
add_action( 'tha_content_before', 'vp_refer_page_header' );
remove_action( 'tha_entry_top', 'vp_entry_title' );
remove_action( 'tha_entry_top', 'vp_entry_subtitle', 12 );
remove_action( 'tha_entry_top', 'vp_entry_header_text', 13 );

/**
 * Refer Page Sidebar
 *
 */
function vp_refer_page_sidebar(){
    wpforms_display( 167 );
    echo '<p class="disclaimer">* Only company leads qualify. Must be a new qualified lead with no existing opportunity. <a href="' . home_url( 'contact-us' ) . '">Email us</a> if you have questions.</p>';
    echo vp_trust_icons_shortcode();
}
add_action( 'tha_sidebar_top', 'vp_refer_page_sidebar' );

// Build the page
require get_template_directory() . '/index.php';
