<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Online Visa Advisor */

// Wide Content
add_filter( 'body_class', 'vp_wide_content' );

/**
 * Visa Advisor Steps
 *
 */
function vp_visa_advisor_steps() {
    $steps = vp_cf( 'vp_steps', get_the_ID(), array( 'cf_type' => 'complex' ) );
    if( empty( $steps ) )
        return;

    echo '<div class="visa-advisor-steps">';
    foreach( $steps as $i => $step ) {
        echo '<div class="step">';
        echo '<h4><span class="number">' . ( $i + 1 ) . '</span> ' . esc_html( $step['title'] ) . '</h4>';
        echo '<div class="description">' . apply_filters( 'vp_the_content', $step['description'] ) . '</div>';
        if( !empty( $step['button_text'] ) && !empty( $step['button_url'] ) ) {
            echo '<a class="' . vp_class( 'button button-block', 'button-outline', $i == 1 ) . '" href="' . esc_url( $step['button_url'] ) . '">' . esc_html( $step['button_text'] ) . '</a>';
        }
        echo '</div>';
    }
    echo '</div>';
}
add_action( 'tha_entry_content_after', 'vp_visa_advisor_steps' );

// Build the page
require get_template_directory() . '/index.php';
