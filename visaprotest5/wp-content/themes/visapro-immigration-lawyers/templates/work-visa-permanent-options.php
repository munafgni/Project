<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Work Visa Permanent Options */

// Medium Layout
add_filter( 'body_class', 'vp_medium_content' );

/**
 * Section Nav
 *
 */
function vp_permanent_visa_options_nav() {
    vp_online_visa_section_nav( 0 );
}
add_action( 'tha_entry_top', 'vp_permanent_visa_options_nav', 15 );


/**
 * Temporary Visa Options Content
 *
 */
function vp_permanent_visa_options_content() {
    echo '<img src="' . get_template_directory_uri() . '/assets/images/demo/permanent-visa-options.jpg" class="block" />';
}
add_action( 'tha_entry_content_before', 'vp_permanent_visa_options_content', 40 );
remove_action( 'tha_entry_content_before', 'vp_entry_content', 40 );

// Build the page
require get_template_directory() . '/index.php';
