<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Login */

// Medium Content
add_filter( 'body_class', 'vp_medium_content' );

/**
 * Login Content
 *
 */
function vp_login_content() {
    echo '<div class="login-content">';
    echo '<div class="left">';
    echo '<iframe class="quenry-iframe" src="http://192.168.42.119:1922/s/login-wp.asp?' . $_SERVER['QUERY_STRING'] . '" width="100%" height="500px" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" onload="resizeIframe(this)" scrolling="no" allowfullscreen="" ></iframe>';
    echo '<p style="text-align:center;"><img src="' . get_template_directory_uri() . '/assets/images/bbb-secure.jpg" /></p>';
    echo '</div><div class="right">';
    echo vp_testimonial_shortcode( array( 'include_button' => false ) );
    echo '</div></div>';
}
add_action( 'tha_entry_content_after', 'vp_login_content' );

// Build the page
require get_template_directory() . '/index.php';
