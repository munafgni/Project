<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: 2 Column Number Listing */

/**
 * Two Column Number Listing
 *
 */
function vp_two_column_number_listing() {

    $items = vp_cf( 'vp_listing', get_the_ID(), array( 'cf_type' => 'complex' ) );
    if( empty( $items ) )
        return;

    echo '<div class="two-column-number-listing">';
    foreach( $items as $i => $item ) {
        echo '<div class="' . vp_column_class( 2, $i ) . '">';
        echo '<span class="large-number">' . ( $i + 1 ) . '</span>';
        $title = !empty( $item['url'] ) && !empty( $item['title'] ) ? '<a href="' . esc_url( $item['url'] ) . '">' . esc_html( $item['title'] ) . ' &raquo;</a>' : esc_html( $item['title'] );
        if( !empty( $title ) )
            echo '<h4>' . $title . '</h4>';
        if( !empty( $item['subtitle'] ) )
            echo '<p class="small">' . esc_html( $item['subtitle'] ) . '</p>';
        echo '</div>';

        // Dividers
        if( $i !== ( count( $items ) - 1 ) ) {
            if( 1 == $i % 2 ) {
                echo '<hr >';
            } else {
                echo '<hr class="visible-xs-block" />';
            }
        }

    }
    echo '</div>';
}
add_action( 'tha_entry_content_after', 'vp_two_column_number_listing' );

// Build the page
require get_template_directory() . '/index.php';
