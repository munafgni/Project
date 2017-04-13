<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: FAQ Answers */

/**
 * FAQ Answers
 *
 */
function vp_faq_answers() {

    $answers = vp_cf( 'vp_faq_answers', get_the_ID(), array( 'cf_type' => 'complex' ) );
    if( ! $answers )
        return;

    $posts_per_page = VP_FAQ_ANSWERS_PER_PAGE;
    $page = isset( $_GET['vp_faq_page'] ) ? intval( $_GET['vp_faq_page'] ) : 1;

    $count = 0;
    foreach( $answers as $i => $answer ) {

        if( $i < $posts_per_page * ( $page - 1 ) || $i > ( $posts_per_page * $page - 1 ) )
            continue;

        if( ! in_array( $count, array( 0, 2 ) ) )
            echo '<hr />';

        echo '<div class="faq-answer" id="faq-' . ( $i + 1 ) . '">';
        if( !empty( $answer['title'] ) )
            echo '<h4>' . ($i + 1 ) . '. ' . esc_html( $answer['title'] ) . '</h4>';
        echo apply_filters( 'vp_the_content', $answer['content'] );
        echo '</div>';

        if( 1 == $i )
            echo vp_cta_shortcode( array( 'type' => 'check_eligibility' ) );

        $count++;

    }

    vp_faq_pagination( count( $answers ), $posts_per_page ); // see inc/navigation.php

}
add_action( 'tha_entry_content_before', 'vp_faq_answers', 40 );
remove_action( 'tha_entry_content_before', 'vp_entry_content', 40 );


// Build the page
require get_template_directory() . '/index.php';
