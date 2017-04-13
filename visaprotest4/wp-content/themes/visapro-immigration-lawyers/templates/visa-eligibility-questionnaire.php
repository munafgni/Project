<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Visa Eligibility Questionnaire */

// Medium Layout
add_filter( 'body_class', 'vp_medium_content' );

/**
 * Section Nav
 *
 */
function vp_visa_questionnaire_nav() {
    vp_online_visa_section_nav( 1 );
}
add_action( 'tha_entry_top', 'vp_visa_questionnaire_nav', 15 );


/**
 * Content
 *
 */
function vp_visa_questionnaire_content() {
    echo '<img src="' . get_template_directory_uri() . '/assets/images/demo/visa-eligibility-questionnaire.jpg" class="block" />';
}
add_action( 'tha_entry_content_before', 'vp_visa_questionnaire_content', 40 );
remove_action( 'tha_entry_content_before', 'vp_entry_content', 40 );

// Build the page
require get_template_directory() . '/index.php';
