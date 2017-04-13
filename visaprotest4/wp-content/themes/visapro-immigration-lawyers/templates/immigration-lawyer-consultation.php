<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Immigration Lawyer Consultation */

// Wide Content
add_filter( 'body_class', 'vp_wide_content' );

/**
 * Content
 *
 */
function vp_immigration_lawyer_content() {
    $list = vp_cf( 'vp_page_header_checks', false, array( 'cf_type' => 'complex' ) );
    if( !empty( $list ) ) {
        echo '<ul class="checks check-smaller blue">';
        foreach( $list as $i => $list_item ) {
            echo '<li class="' . vp_column_class( 2, $i ) . '">' . esc_html( $list_item['item'] ) . '</li>';
        }
        echo '</ul>';
    }
    echo vp_consultation_timeline();
    echo '<div class="sign-up">';
        echo '<span class="left">';
            echo '<span class="pricing">' . esc_html( vp_cf( 'vp_immigration_consult_intro' ) ) . '</span>';
            echo '<a href="' . esc_url( vp_cf( 'vp_immigration_consult_url' ) ) . '" class="button">' . esc_html( vp_cf( 'vp_immigration_consult_text' ) ) . '</a>';
            echo '<span class="button-info">Sign up and send your questions securely</span>';
        echo '</span>';
        echo '<span class="learn-more">OR <a href="' . esc_url( vp_cf( 'vp_immigration_learn_more' ) ) . '">Learn More</a></span>';
        echo vp_trust_icons_shortcode( array( 'align' => 'center' ));
    echo '</div>';
}
add_action( 'tha_entry_content_before', 'vp_immigration_lawyer_content', 40 );
remove_action( 'tha_entry_content_before', 'vp_entry_content', 40 );

/**
 * Service Options
 *
 */
function vp_immigration_lawyer_service_options() {
    echo '<div class="service-options"><div class="wrap">';
    echo apply_filters( 'vp_the_content', vp_cf( 'vp_immigration_content' ) );
    $boxes = vp_cf( 'vp_boxes', false, array( 'cf_type' => 'complex' ) );
    foreach( $boxes as $i => $box ) {
        echo '<div class="service-box">';
            echo '<h4>' . $box['title'] . '</h4>';
            echo '<div class="service-box-content">' . apply_filters( 'vp_the_content', $box['content'] ) . '</div>';
            echo '<div class="sign-up">';
                echo '<span class="left">';
                    echo '<span class="pricing">' . esc_html( $box['pricing'] ) . '</span>';
                    echo '<a href="' . esc_url( $box['button_url'] ) . '" class="' . vp_class( 'button', 'button-outline', $i == 1 ) . '">' . esc_html( $box['button_text'] ) . '</a>';
                    echo '<span class="button-info">Sign up and send your questions securely</span>';
                echo '</span>';
                echo '<span class="learn-more">OR <a href="' . esc_url( $box['learn_more'] ) . '">Learn More</a></span>';
            echo '</div>';
        echo '</div>';
    }
    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_immigration_lawyer_service_options', 5 );

/**
 * Testimonial
 *
 */
function vp_immigration_lawyer_testimonial() {
    $testimonial = vp_cf( 'vp_immigration_testimonial' );
    if( $testimonial )
        echo '<div class="testimonial-section"><div class="wrap">' . apply_filters( 'vp_the_content', $testimonial ) . '</div></div>';
}
add_action( 'tha_footer_before', 'vp_immigration_lawyer_testimonial', 5 );

// Build the page
require get_template_directory() . '/index.php';
