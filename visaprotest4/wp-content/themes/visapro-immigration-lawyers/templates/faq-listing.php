<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: FAQ Listing */

/**
 * FAQ Listing
 *
 */
function vp_faq_listing() {

    $faq = vp_cf( 'vp_faq', get_the_ID(), array( 'cf_type' => 'complex' ) );
    if( ! $faq )
        return;

    $posts_per_page = VP_FAQ_PER_PAGE;
    $page = isset( $_GET['vp_faq_page'] ) ? intval( $_GET['vp_faq_page'] ) : 1;

    echo '<table class="table table-striped table-bordered table-links"><tbody>';
    foreach( $faq as $i => $faq_item ) {

        if( $i < $posts_per_page * ( $page - 1 ) || $i > ( $posts_per_page * $page - 1 ) )
            continue;

        echo '<tr><td><a href="' . vp_faq_answer_url( $i ). '">' . ( $i + 1 ) . '. ' . esc_html( $faq_item['title'] ) . '</a></td></tr>';
    }
    echo '</tbody></table>';

    vp_faq_pagination( count( $faq ), $posts_per_page ); // see inc/navigation.php

}
add_action( 'tha_entry_content_before', 'vp_faq_listing', 40 );
remove_action( 'tha_entry_content_before', 'vp_entry_content', 40 );

/**
 * FAQ Answer URL
 *
 */
function vp_faq_answer_url( $i = 0 ) {
    $url = esc_url_raw( vp_cf( 'vp_faq_answer_url' ) );

    $posts_per_page = VP_FAQ_ANSWERS_PER_PAGE;
    $page = ceil( ( $i + 1 ) / $posts_per_page );
    if( 1 < $page )
        $url .= '?vp_faq_page=' . $page;

    $url .= '#faq-' . ( $i + 1 );

    return esc_url_raw( $url );

}

// Build the page
require get_template_directory() . '/index.php';
