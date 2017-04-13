<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Signup */

// Medium Content
add_filter( 'body_class', 'vp_medium_content' );

/**
 * Signup Content
 *
 */
function vp_signup_content() {
    echo '<div class="signup-content">';
    echo '<div class="left">';
     echo '<iframe class="quenry-iframe" src="http://192.168.42.119:1922/signup-wp.asp?' . $_SERVER['QUERY_STRING'] . '" style="width: 100%; height:830px; border: 0px none;" onload="resizeIframe(this)" scrolling="no" allowfullscreen=""  ></iframe>';
   // echo '<p class="disclaimer with-lock"><i class="icon-lock"></i>We value your <a href="' . home_url( 'about/privacy-policy' ) . '" target="_new">privacy</a>. <br />We will not rent or sell your email address.</p>';
  //  echo '<p style="text-align:center;"><img src="' . get_template_directory_uri() . '/assets/images/signup-logos.jpg" /></p>';
    echo '</div><div class="right">';
    echo vp_testimonial_shortcode( array( 'id' => 0, 'include_button' => false ) );
    echo '<hr />';
    echo vp_testimonial_shortcode( array( 'id' => 1, 'include_title' => false, 'include_button' => false ) );
    echo '</div></div>';
}
add_action( 'tha_entry_content_after', 'vp_signup_content' );

// Build the page
require get_template_directory() . '/index.php';
