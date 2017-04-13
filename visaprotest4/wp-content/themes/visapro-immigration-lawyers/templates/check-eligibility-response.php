<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Check Eligibility Response */

// Medium Layout
add_filter( 'body_class', 'vp_medium_content' );

/**
 * Section Nav
 *
 */
function vp_check_eligibility_response_nav() {
    vp_online_visa_section_nav( 1 );
}
add_action( 'tha_entry_top', 'vp_check_eligibility_response_nav', 15 );

/**
 * Message
 *
 */
function vp_eligibility_message() {
    $message = vp_cf( 'vp_eligibility_message' );
    if( $message )
        echo '<div class="intro-box">' . apply_filters( 'vp_the_content', $message ) . '</div>';
}
add_action( 'tha_entry_top', 'vp_eligibility_message', 18 );

/**
 * Bottom
 *
 */
function vp_eligibility_bottom() {
    $left = vp_cf( 'vp_eligibility_bottom_left' );
    $right = vp_cf( 'vp_eligibility_bottom_right' );

    if( empty( $left ) && empty( $right ) )
        return;

    echo '<div class="bottom-left">' . apply_filters( 'vp_the_content', $left ) . '</div>';
    echo '<div class="bottom-right">' . apply_filters( 'vp_the_content', $right ) . '</div>';
}
add_action( 'tha_entry_bottom', 'vp_eligibility_bottom' );

// Build the page
require get_template_directory() . '/index.php';
