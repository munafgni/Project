<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Thank You */

// Simplified Header, see inc/navigation.php
vp_simplified_header();


/**
 * Body Class
 *
 */
function vp_thank_you_body_class( $classes ) {
    $layout = vp_cf( 'vp_thank_you_layout' );
    if( 'content_sidebar' == $layout ) {
        $classes[] = 'content-sidebar';
        $classes[] = 'page-template-content-sidebar';
        $classes[] = 'style-narrow';
        add_filter( 'vp_page_layout', 'vp_return_content_sidebar' );

    }
    return $classes;
}
add_filter( 'body_class', 'vp_thank_you_body_class' );

/**
 * Intro Box
 *
 */
function vp_thank_you_intro_box() {

    $intro = vp_cf( 'vp_thank_you_intro' );
    if( $intro )
        echo '<div class="thank-you-intro"><div class="wrap"><div class="intro-box">' . apply_filters( 'vp_the_content', $intro ) . '</div></div></div>';

}
add_action( 'tha_header_after', 'vp_thank_you_intro_box', 20 );

/**
 * Remove Page Title
 *
 */
function vp_thank_you_remove_title() {
    $remove = vp_cf( 'vp_thank_you_remove_title' );
    if( $remove )
        remove_action( 'tha_entry_top', 'vp_entry_title' );

}
add_action( 'wp_head', 'vp_thank_you_remove_title' );


/**
 * Content Style
 *
 */
function vp_content_sidebar_style( $classes ) {
    $classes[] = esc_attr( 'style-' . vp_cf( 'vp_content_width' ) );
    return $classes;
}
//add_filter( 'body_class', 'vp_content_sidebar_style' );

/**
 * Page Header
 *
 */
function vp_cs_page_header() {

    $layout = vp_cf( 'vp_thank_you_layout' );
    if( 'content_sidebar' != $layout )
        return;

    remove_action( 'tha_entry_top', 'vp_entry_title' );
    remove_action( 'tha_entry_top', 'vp_entry_subtitle', 12 );
    remove_action( 'tha_entry_top', 'vp_entry_header_text', 13 );

    echo '<div class="page-header">';

    $remove = vp_cf( 'vp_thank_you_remove_title' );
    if( ! $remove )
        vp_entry_title();

    vp_entry_subtitle();
    vp_entry_header_text();
    echo '</div>';
}
add_action( 'tha_content_before', 'vp_cs_page_header' );

/**
 * Sidebar
 *
 */
function vp_cs_sidebar(){

    $layout = vp_cf( 'vp_thank_you_layout' );
    if( 'content_sidebar' == $layout )
        echo apply_filters( 'vp_the_content', vp_cf( 'vp_thank_you_sidebar' ) );

}
add_action( 'tha_sidebar_top', 'vp_cs_sidebar' );

// Build the page
require get_template_directory() . '/index.php';
