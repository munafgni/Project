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
 * Default Loop
 *
 */
function vp_default_loop() {

	if ( have_posts() ) :

		tha_content_while_before();

		/* Start the Loop */
		while ( have_posts() ) : the_post();

			tha_entry_before();
			if( is_singular() ) {
				get_template_part( 'partials/content', get_post_type() );
			} elseif( is_search() ) {
				get_template_part( 'partials/search' );
			} else {
				$format = vp_cf( 'vp_post_format' );
				get_template_part( 'partials/archive', $format );
			}
			tha_entry_after();

		endwhile;

		tha_content_while_after();

	else :

		tha_entry_before();
		get_template_part( 'partials/content', 'none' );
		tha_entry_after();

	endif;

}
add_action( 'tha_content_loop', 'vp_default_loop' );

/**
 * Entry Title
 *
 */
function vp_entry_title() {

	$title = vp_cf( 'vp_page_title' );
	if( empty( $title ) )
		$title = get_the_title();
    $title = apply_filters( 'vp_entry_title_text', $title );

    if( $title && is_singular() ) {
        echo '<h1 class="entry-title">' . $title . '</h1>';
    } elseif( $title ) {
        echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $title . '</a></h2>';
    }
}
add_action( 'tha_entry_top', 'vp_entry_title' );

/**
 * Entry Subtitle
 *
 */
function vp_entry_subtitle() {
	if( ! is_singular() )
		return;

	$subtitle = vp_cf( 'vp_page_subtitle' );
	$subtitle = apply_filters( 'vp_entry_subtitle_text', $subtitle );

	if( !empty( $subtitle ) )
		echo '<h2 class="entry-subtitle">' . esc_html( $subtitle ) . '</h2>';
}
add_action( 'tha_entry_top', 'vp_entry_subtitle', 12 );

/**
 * Page Header Text
 *
 */
function vp_entry_header_text() {
	$text = vp_cf( 'vp_page_header_text' );
	if( $text )
		echo '<p>' . esc_html( $text ) . '</p>';
}
add_action( 'tha_entry_top', 'vp_entry_header_text', 13 );

/**
 * Post Date
 *
 */
function vp_entry_date() {

	if( 'post' !== get_post_type() )
		return;

	$date = is_singular() ? get_the_date( 'F j, Y' ) : '<span class="month">' . get_the_date( 'M' ) . '</span> <span class="day">' . get_the_date( 'j' ) . '</span>';
    echo '<p class="entry-date">' . $date . '</p>';
}
add_action( 'tha_entry_top', 'vp_entry_date', 12 );

/**
 * Entry Content
 *
 */
function vp_entry_content() {

	if( ! is_singular() )
		return;

	the_content();

	wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ea' ),
		'after'  => '</div>',
	) );

}
add_action( 'tha_entry_content_before', 'vp_entry_content', 40 );

/**
 * Post Comments
 *
 */
function vp_comments() {

	if ( is_singular() && ( comments_open() || get_comments_number() ) ) {
		comments_template();
	}

}
add_action( 'tha_content_while_after', 'vp_comments' );
