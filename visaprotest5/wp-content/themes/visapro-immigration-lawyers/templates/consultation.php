<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Consultation */

// Content Sidebar layout
add_filter( 'vp_page_layout', 'vp_return_content_sidebar' );

/**
 * Page Header
 *
 */
function vp_consultation_page_header() {
    echo '<div class="page-header">';
    vp_entry_title();
    vp_entry_subtitle();
    vp_entry_header_text();
    echo vp_consultation_timeline();
    echo '</div>';
}
add_action( 'tha_content_before', 'vp_consultation_page_header' );
remove_action( 'tha_entry_top', 'vp_entry_title' );
remove_action( 'tha_entry_top', 'vp_entry_subtitle', 12 );
remove_action( 'tha_entry_top', 'vp_entry_header_text', 13 );

/**
 * Sidebar
 *
 */
function vp_consultation_sidebar(){
    echo '<h4>What VisaPro<br />Customers Are Saying</h4>';
    echo apply_filters( 'vp_the_content', vp_stars() . vp_cf( 'vp_testimonial' ) );
}
add_action( 'tha_sidebar_top', 'vp_consultation_sidebar' );

/**
 * Success Story Listing
 *
 */
function vp_consultation_success_story_listing() {
    echo '<div class="success-stories"><div class="wrap">';
    vp_cf( 'vp_success_story_section_subtitle', false, array( 'echo' => true, 'escape' => 'esc_html', 'prepend' => '<p class="subtitle">', 'append' => '</p>' ) );
    vp_cf( 'vp_success_story_section_title', false, array( 'echo' => true, 'prepend' => '<h2>', 'append' => '</h2>' ) );

    $stories = vp_cf( 'vp_success_stories', false, array( 'cf_type' => 'complex' ) );
    foreach( $stories as $i => $story ) {
        echo '<div class="success-story">';
        if( !empty( $story['image'] ) )
            echo '<p>' . wp_get_attachment_image( intval( $story['image'] ), 'thumbnail', null, array( 'class' => 'aligncenter' ) ) . '</p>';
        if( !empty( $story['title'] ) )
            echo '<h5>' . esc_html( $story['title'] ) . '</h5>';
        echo '<p class="summary">' . $story['summary'] . '</p>';
        if( !empty( $story['url'] ) )
            echo '<p class="more"><a href="' . esc_url( $story['url'] ) . '">Read Full Success Story <i class="icon-angle-double-right"></i></a></p>';
        echo '</div>';
    }

    $logos = vp_cf( 'vp_customer_logos' );
    if( $logos ) {
        echo '<div class="customer-logos">';
        echo '<h5><span>Customers Using VisaPro</span></h5>';
        echo wp_get_attachment_image( $logos, 'full', null, array( 'class' => 'aligncenter' ) );
        echo '</div>';
    }
    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_consultation_success_story_listing', 5 );

/**
 * Consultation CTA
 *
 */
function vp_consultation_cta() {
    $text = esc_html( vp_cf( 'vp_cta_text' ) );
    if( ! $text )
        return;

    $button = false;
    $button_url = esc_url( vp_cf( 'vp_cta_button_url' ) );
    $button_text = esc_html( vp_cf( 'vp_cta_button_text' ) );
    $button_info = esc_html( vp_cf( 'vp_cta_button_info' ) );
    if( $button_text && $button_url )
        $button = '<a class="button button-orange" href="' . $button_url . '">' . $button_text . '</a>';
    if( $button && $button_info )
        $button .= ' <span class="button-info">' . $button_info . '</span>';
    if( $button )
        $button = '<span class="cta-button">' . $button . '</span>';


    echo '<div class="consultation-cta"><div class="wrap"><span class="cta-text">' . $text . '</span>' . $button . '</div></div>';
}
add_action( 'tha_footer_before', 'vp_consultation_cta', 5 );

// Build the page
require get_template_directory() . '/index.php';
