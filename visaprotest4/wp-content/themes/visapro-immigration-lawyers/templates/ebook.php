<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Ebook*/

// Content Sidebar layout
add_filter( 'vp_page_layout', 'vp_return_content_sidebar' );

// Simplified Header, see inc/navigation.php
vp_simplified_header();

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
    wpforms_display( 380, true, false );
    echo '<p class="disclaimer" style="margin: 0;"><i class="icon-lock"></i>We value your <a href="' . home_url( 'about/privacy-policy' ) . '">privacy</a>.<br />We will not rent or sell your email address.</p>';
    echo '<hr />';
    echo vp_testimonial_shortcode( array( 'include_button' => false ) );
}
add_action( 'tha_sidebar_top', 'vp_cs_sidebar' );

// Build the page
require get_template_directory() . '/index.php';
