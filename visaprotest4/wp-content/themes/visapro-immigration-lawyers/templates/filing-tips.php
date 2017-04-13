<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

 /* Template Name: Filing Tips */

// Remove section nav
remove_action( 'tha_entry_top', 'vp_visa_section_nav', 15 );

/**
 * Filing Tips Listing
 *
 */
function vp_filing_tips_listing() {

    $extra_links = array();
    $links = vp_cf( 'fp_tip_links', get_the_ID(), array( 'cf_type' => 'complex' ) );
    if( !empty( $links ) ) {
        foreach( $links as $link )
            $extra_links[] = '<a href="' . esc_url( $link['url'] ) . '">' . esc_html( $link['title'] ) . '</a>';
    }
    $extra_links = !empty( $extra_links ) ? '<p class="extra">' . join( ' | ', $extra_links ) . '</p>' : '';

    $loop = new WP_Query( array(
        'post_type'                 => 'page',
        'post_parent'               => get_queried_object_id(),
        'posts_per_page'            => 99,
        'orderby'                   => 'menu_order',
        'order'                     => 'ASC',
        'no_found_rows'             => true,
        'update_post_term_cache'    => false,
    ) );

    if( $loop->have_posts() ):
        echo '<div class="filing-tips">';
        while( $loop->have_posts() ): $loop->the_post();
            echo '<div class="tip">';
                echo '<a class="entry-image-link" href="' . get_permalink() . '">' . wp_get_attachment_image( vp_post_image_id(), 'vp_small' ) . '</a>';
                echo '<h4><strong>' . vp_tip_title( get_the_ID(), get_queried_object_id() ) . ':</strong> ' . vp_cf( 'vp_tip_short_title' ) . '</h4>';
                echo '<p class="more"><a href="'. get_permalink() . '">Read the Tip >></a></p>';
                echo $extra_links;
            echo '</div>';
        endwhile;
        echo '</div>';
    endif;
}
add_action( 'tha_entry_content_before', 'vp_filing_tips_listing' );
remove_action( 'tha_entry_content_before', 'vp_entry_content' );

// Build the page
require get_template_directory() . '/index.php';
