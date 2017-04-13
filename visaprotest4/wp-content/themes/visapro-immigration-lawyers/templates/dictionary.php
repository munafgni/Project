<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Dictionary */

// Wide Content
add_filter( 'body_class', 'vp_wide_content' );

/**
 * Dictionary Page Title
 *
 */
function vp_dictionary_page_title( $title ) {
    global $post;
    $title = vp_cf( 'vp_page_title', $post->post_parent );
	if( empty( $title ) )
		$title = get_the_title( $post->post_parent );
    return $title;
}
add_filter( 'vp_entry_title_text', 'vp_dictionary_page_title' );

/**
 * Dictionary Page Subtitle
 *
 */
function vp_dictionary_page_subtitle( $subtitle ) {
    global $post;
    $subtitle = vp_cf( 'vp_page_subtitle', $post->post_parent );
    return $subtitle;
}
add_filter( 'vp_entry_subtitle_text', 'vp_dictionary_page_subtitle' );

// Dictionary Nav
add_action( 'tha_entry_top', 'vp_dictionary_nav', 20 );

/**
 * Dictionary Content
 *
 */
function vp_dictionary_template_content( $post_id = false ) {

    $post_id = $post_id ? intval( $post_id ) : get_the_ID();
    $items = vp_cf( 'vp_dictionary', $post_id, array( 'cf_type' => 'complex' ) );
    if( empty( $items ) )
        return;

    echo '<div class="table-responsive"><table class="table table-striped table-bordered"><tbody>';
    foreach( $items as $item ) {
        echo '<tr>';
        $term = esc_html( $item['term'] );
        if( !empty( $item['url'] ) )
            $term = '<a href="' . esc_url( $item['url'] ) . '">' . $term . '</a>';
        echo '<td>' . $term . '</td>';
        echo '<td>' . wp_kses_post( $item['definition'] ) . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table></div>';
}
add_action( 'tha_entry_content_before', 'vp_dictionary_template_content', 40 );
remove_action( 'tha_entry_content_before', 'vp_entry_content', 40 );

// Build the page
require get_template_directory() . '/index.php';
