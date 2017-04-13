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
    echo '<iframe class="quenry-iframe" src="http://192.168.42.245:1914/us-visa-status-wp.asp?' . $_SERVER['QUERY_STRING'] . '" width="100%" height="500px" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" onload="resizeIframe(this)" scrolling="no" allowfullscreen="" ></iframe>';
    echo '<p class="disclaimer with-lock"><i class="icon-lock"></i>We value your <a href="' . home_url( 'about/privacy-policy' ) . '">privacy</a>.<br />We will not rent or sell your email address.</p>';
    echo '<p><img src="' . get_template_directory_uri() . '/assets/images/bbb-secure.jpg" class="aligncenter" /></p>';
    echo '</div><div class="content-right">';
    echo vp_testimonial_shortcode( array( 'include_button' => false ) );
    echo '</div>';
}
add_action( 'tha_entry_content_after', 'vp_us_visa_status_content' );

// Build the page
require get_template_directory() . '/index.php';
