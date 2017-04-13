<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Filing Tip */

// Remove section nav
remove_action( 'tha_entry_top', 'vp_visa_section_nav', 15 );

/**
 * Filing Tip Loop
 *
 */
function vp_filing_tip_loop() {
    if( have_posts() ): while( have_posts() ): the_post();

        $id = get_the_ID();
        echo '<h1 class="entry-title">' . vp_tip_title( $id ) . ':<br /><span class="short-title">' . esc_html( vp_cf( 'vp_tip_short_title', $id ) ) . '</h1>';

        echo '<div class="filing-tip">';
            echo '<p class="title">' . get_the_title( $id ) . '</p>';
            echo '<p class="summary">' . esc_html( vp_cf( 'vp_tip_long_title', $id ) ) . '</p>';
            echo '<p class="description">' . esc_html( vp_cf( 'vp_tip_content', $id ) ) . '</p>';
        echo '</div>';

    endwhile; endif;
}
add_action( 'tha_content_loop', 'vp_filing_tip_loop' );
remove_action( 'tha_content_loop', 'vp_default_loop' );

// Related Articles
add_filter( 'vp_display_related_articles', '__return_true' );


// Build the page
require get_template_directory() . '/index.php';
