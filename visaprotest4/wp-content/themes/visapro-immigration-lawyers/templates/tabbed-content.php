<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Tabbed Content */

/**
 * Tabbed Content
 *
 */
function vp_tabbed_content() {
    $tabs = vp_cf( 'vp_tabs', false, array( 'cf_type' => 'complex' ) );
    if( ! $tabs )
        return;

    echo '<div class="tab-section">';

    echo '<ul class="tab-nav">';
    foreach( $tabs as $i => $tab ) {
        echo '<li><a href="#' . sanitize_title( $tab['title'] ) . '" class="' . vp_class( 'no-scroll', 'current', $i == 0 ) . '">' . esc_html( $tab['title'] ) . '</a>';
    }
    echo '</ul>';

    foreach( $tabs as $i => $tab ) {
        echo '<div class="' . vp_class( 'tab-content', 'current', $i == 0 ) . '" id="' . sanitize_title( $tab['title'] ) . '">';
        echo apply_filters( 'vp_the_content', $tab['content'] );
        echo '</div>';
    }

    echo '</div>';
}
add_action( 'tha_entry_content_before', 'vp_tabbed_content', 40 );
remove_action( 'tha_entry_content_before', 'vp_entry_content', 40 );


// Build the page
require get_template_directory() . '/index.php';
