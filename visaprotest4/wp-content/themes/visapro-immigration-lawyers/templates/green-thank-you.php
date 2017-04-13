<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Thank You, Green */

/**
 * More Information
 *
 */
function vp_green_thank_you_more_info() {
    $more_info = vp_cf( 'vp_more_information', get_the_ID(), array( 'cf_type' => 'complex' ) );
    if( ! $more_info )
        return;

    echo '<div class="more-information"><div class="wrap">';
    echo '<hr />';
    vp_cf( 'vp_more_information_title', get_the_ID(), array( 'echo' => 'true', 'escape' => 'esc_html', 'prepend' => '<h4>', 'append' => '</h4>' ) );
    foreach( $more_info as $item ) {
        echo '<div class="item">';
        $image = wp_get_attachment_image( $item['image'], 'full' );
        if( !empty( $item['link_url'] ) )
            $image = '<a href="' . esc_url( $item['link_url'] ) . '">' . $image . '</a>';
        echo $image;
        echo '<div class="item-content">' . apply_filters( 'vp_the_content', $item['content'] ) . '</div>';
        if( !empty( $item['link_text'] ) && !empty( $item['link_url'] ) )
            echo '<a class="more-link" href="' . esc_url( $item['link_url'] ) . '"><span>' . esc_html( $item['link_text'] ) . '</span> <i class="icon-angle-double-right"></i></a>';
        echo '</div>';
    }
    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_green_thank_you_more_info', 5 );

// Build the page
require get_template_directory() . '/index.php';
