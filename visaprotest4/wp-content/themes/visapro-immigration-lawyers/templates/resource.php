<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Resource */

// Content Sidebar layout
add_filter( 'vp_page_layout', 'vp_return_content_sidebar' );

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
    wpforms_display( 387, true, true );
    echo '<p class="disclaimer"><i class="icon-lock"></i>We value your <a href="' . home_url( 'about/privacy-policy' ) . '">privacy</a>.<br />We will not rent or sell your email address.</p>';
    echo vp_trust_icons_shortcode( array( 'align' => 'center' ) );
}
add_action( 'tha_sidebar_top', 'vp_cs_sidebar' );

/**
 * Resource Footer
 *
 */
function vp_resource_footer() {
    echo '<div class="resource-footer"><div class="wrap">';
    echo vp_social_sharing();
    echo vp_disqus_comments();
    echo vp_testimonial_shortcode();
    echo '</div></div>';
}
add_action( 'tha_sidebars_after', 'vp_resource_footer', 2 );


// Build the page
require get_template_directory() . '/index.php';
