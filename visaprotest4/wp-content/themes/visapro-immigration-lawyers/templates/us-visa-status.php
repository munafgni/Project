<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: US Visa Status */

// Medium Layout
add_filter( 'body_class', 'vp_medium_content' );

/**
 * US Visa Status Content
 *
 */
function vp_us_visa_status_content() {
    echo '<div class="content-left">';
    echo '<p><img src="'. get_template_directory_uri() . '/assets/images/demo/sample-us-visa-status.jpg" class="block" /></p>';
    echo '<p class="disclaimer with-lock"><i class="icon-lock"></i>We value your <a href="' . home_url( 'about/privacy-policy' ) . '">privacy</a>.<br />We will not rent or sell your email address.</p>';
    echo '<p><img src="' . get_template_directory_uri() . '/assets/images/bbb-secure.jpg" class="aligncenter" /></p>';
    echo '</div><div class="content-right">';
    echo vp_testimonial_shortcode( array( 'include_button' => false ) );
    echo '</div>';
}
add_action( 'tha_entry_content_after', 'vp_us_visa_status_content' );

// Build the page
require get_template_directory() . '/index.php';
