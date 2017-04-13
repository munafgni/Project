<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/**
 * Post Extras
 *
 */
function vp_single_post_extras() {

    // Video
    $video = vp_cf( 'vp_video_url' );
    if( $video )
        echo '<p>' . wp_oembed_get( esc_url( $video ) ) . '</p>';
}
add_action( 'tha_entry_content_before', 'vp_single_post_extras' );

/**
 * After Post
 *
 */
function vp_single_after_post() {

    // Check Eligiblity
    echo vp_cta_shortcode( array( 'type' => 'check_eligibility' ) );

    // Categories
    echo '<h6>View All Categories</h6>';
    echo vp_blog_categories();
    // Sharing
    echo vp_social_sharing();
}
add_action( 'tha_entry_after', 'vp_single_after_post' );

/**
 * Testimonials
 *
 */
function vp_single_post_testimonials() {
    echo vp_testimonial_shortcode();
}
add_action( 'tha_comments_after', 'vp_single_post_testimonials' );

// Build the page
require get_template_directory() . '/index.php';
