<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/**
 * Body Class
 *
 */
function vp_blog_body_class( $classes ) {
    $classes[] = 'blog-archive';
    return $classes;
}
add_filter( 'body_class', 'vp_blog_body_class' );

/**
 * Blog Intro
 *
 */
function vp_blog_intro() {
    echo '<div class="blog-intro">';
    echo '<h1 class="archive-title">' . get_the_title( get_option( 'page_for_posts' ) ) . '</h1>';
    echo vp_blog_categories();
    echo '</div>';
}
add_action( 'tha_content_top', 'vp_blog_intro' );

/**
 * Post Extras
 *
 */
function vp_blog_post_extras() {

	if( 'post' !== get_post_type() )
		return;

    // Video
    $video = vp_cf( 'vp_video_url' );
    if( $video )
        echo '<p>' . wp_oembed_get( esc_url( $video ) ) . '</p>';

    // Featured Image
    $include_image = vp_cf( 'vp_display_archive_image' );
    if( $include_image && has_post_thumbnail() )
        echo get_the_post_thumbnail( get_the_ID(), 'vp_main', array( 'class' => 'featured-image' ) );
}
add_action( 'tha_entry_top', 'vp_blog_post_extras', 5 );

/**
 * Read More
 *
 */
function vp_blog_read_more() {
    $format = vp_cf( 'vp_post_format' );
    if( ! in_array( $format, array( 'link', 'quote' ) ) )
        echo '<p><a href="' . get_permalink() . '" class="button">View More</a></p>';
}
add_action( 'tha_entry_content_after', 'vp_blog_read_more' );


// Build the page
require get_template_directory() . '/index.php';
