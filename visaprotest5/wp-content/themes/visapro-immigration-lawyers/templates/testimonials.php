<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Testimonials */

/**
 * Testimonials Content
 *
 */
function vp_testimonial_template_content( $post_id = false ) {

    $id = $post_id ? intval( $post_id ) : get_the_ID();
    $testimonials = vp_cf( 'vp_testimonials', $id, array( 'cf_type' => 'complex' ) );
    if( empty( $testimonials ) )
        return;

    echo '<div class="testimonials-listing">';
    foreach( $testimonials as $i => $testimonial ) {
        echo '<div class="testimonial">';
        echo apply_filters( 'vp_the_content', $testimonial['quote'] );
        $byline = '<strong>' . esc_html( $testimonial['name'] ) . '</strong>';
        if( !empty( $testimonial['location'] ) )
            $byline .= ',<br />' . esc_html( $testimonial['location'] );
        echo '<div class="testimonial-byline"><p>' . $byline . '</p>' . wp_get_attachment_image( $testimonial['image'], 'thumbnail', null, array( 'class' => 'no-border' ) ) . '</div>';
        echo '</div>';

        if( 1 == $i ) {
            echo vp_cta_shortcode( array( 'type' => 'free_assessment_form' ) );
            echo '<p style="text-align:center;">' . vp_trust_icons_shortcode() . '<p>';
            echo '<hr />';
        }
    }
    echo '</div>';

    echo vp_cta_shortcode( array( 'type' => 'get_started' ) );
}
add_action( 'tha_entry_content_before', 'vp_testimonial_template_content' );
remove_action( 'tha_entry_content_before', 'vp_entry_content' );

// Build the page
require get_template_directory() . '/index.php';
