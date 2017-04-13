<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Newsletters */

// Medium Content
add_filter( 'body_class', 'vp_medium_content' );

/**
 * Newsletter Listing
 *
 */
function vp_newsletter_listing() {
    $years = vp_cf( 'fp_newsletter_years', get_the_ID(), array( 'cf_type' => 'complex' ) );
    if( empty( $years ) )
        return;

    echo '<div class="newsletter-listing">';
    foreach( $years as $year ) {
        echo '<div class="year">';
        echo '<h5>' . esc_html( $year['year'] ) . '</h5>';
        echo '<ul class="four-columns">';
        foreach( $year['newsletters'] as $newsletter ) {
            echo '<li>';
            $name = esc_html( $newsletter['month'] );
            if( !empty( $newsletter['url'] ) )
                $name = '<a href="' . esc_url( $newsletter['url'] ) . '">' . $name . '</a>';
            echo $name;
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
    echo '</div>';
}
add_action( 'tha_entry_content_after', 'vp_newsletter_listing' );

// Build the page
require get_template_directory() . '/index.php';
