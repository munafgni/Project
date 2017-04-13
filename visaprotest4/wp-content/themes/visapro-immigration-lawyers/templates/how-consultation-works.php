<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: How Consultation Works */

// Wide Content
add_filter( 'body_class', 'vp_wide_content' );

/**
 * Content
 *
 */
function vp_consultation_works_content() {

    vp_cf( 'vp_consultation_section_title', get_the_ID(), array(
        'echo'    => true,
        'escape'  => 'esc_html',
        'prepend' => '<h2>',
        'append'  => '</h2>'
    ));

    $boxes = vp_cf( 'vp_consultation_boxes', get_the_ID(), array( 'cf_type' => 'complex' ) );
    foreach( $boxes as $i => $box ) {
        echo '<div class="consultation-option">';
        if( !empty( $box['title'] ) )
            echo '<h4>' . $box['title'] . '</h4>';
        echo apply_filters( 'vp_the_content', $box['summary'] );
        if( !empty( $box['price'] ) )
            echo '<p><em>' . $box['price'] . '</em></p>';
        if( !empty( $box['button_url'] ) && !empty( $box['button_text'] ) ) {
            echo '<span class="button-wrapper">';
            echo '<a class="'.  vp_class( 'button', 'button-outline', $i == 1 ) . '" href="' . esc_url( $box['button_url'] ) . '">' . esc_html( $box['button_text'] ) . '</a>';
            if( !empty( $box['button_info'] ) )
                echo '<span class="button-info">' . esc_html( $box['button_info'] ) . '</span>';
            echo '</span>';
        }
        echo '</div>';
    }
}
add_action( 'tha_entry_content_before', 'vp_consultation_works_content', 40 );
remove_action( 'tha_entry_content_before', 'vp_entry_content', 40 );

/**
 * Consultation Steps
 *
 */
function vp_consultation_steps() {
    echo '<div class="consultation-steps"><div class="wrap">';

    vp_cf( 'vp_consultation_steps_title', get_the_ID(), array(
        'echo'    => true,
        'prepend' => '<h2>',
        'append'  => '</h2>'
    ) );
    vp_cf( 'vp_consultation_steps_subtitle', get_the_ID(), array(
        'echo'    => true,
        'prepend' => '<h4>',
        'append'  => '</h4>'
    ) );

    echo '<div class="step-container">';
    $steps = vp_cf( 'vp_consultation_steps', get_the_ID(), array( 'cf_type' => 'complex' ) );
    foreach( $steps as $i => $step ) {
        echo '<div class="step">';
            echo '<h5>' . '<span class="number">' . ( $i + 1 ) . '</span> ' . esc_html( $step['title'] ) . '</h5>';
            echo apply_filters( 'vp_the_content', $step['content'] );
        echo '</div>';
    }
    $note = vp_cf( 'vp_consultation_steps_note' );
    if( $note )
        echo '<div class="note">' . $note . '</div>';
    echo '</div>';

    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_consultation_steps', 5 );

// Build the page
require get_template_directory() . '/index.php';
