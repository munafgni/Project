<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: US Visa Eligibility */

// Medium Layout
add_filter( 'body_class', 'vp_medium_content' );

/**
 * Section Nav
 *
 */
function vp_us_visa_eligibility_nav() {
    vp_online_visa_section_nav( 1 );
}
add_action( 'tha_entry_top', 'vp_us_visa_eligibility_nav', 15 );


/**
 * Content
 *
 */
function vp_us_visa_eligibility_content() {
    echo '<div class="content-left">';
    echo '<img src="'. get_template_directory_uri() . '/assets/images/demo/visa-eligibility.jpg" class="block" />';
    echo '</div><div class="content-right">';
    the_content();
    echo '</div>';
}
add_action( 'tha_entry_content_before', 'vp_us_visa_eligibility_content', 40 );
remove_action( 'tha_entry_content_before', 'vp_entry_content', 40 );

// Build the page
require get_template_directory() . '/index.php';
