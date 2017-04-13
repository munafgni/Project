<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Newsletter */

/**
 * Newsletter Header
 *
 */
function vp_newsletter_header() {
    echo '<img src="' . get_template_directory_uri() . '/assets/images/newsletter-header.jpg" class="block" />';
}
add_action( 'tha_entry_top', 'vp_newsletter_header', 5 );

/**
 * Editors Desk
 *
 */
function vp_newsletter_editors_desk() {
    echo '<h2 class="section-header">From the Editor\'s Desk</h2>';
}
add_action( 'tha_entry_top', 'vp_newsletter_editors_desk', 15 );

/**
 * Signature
 *
 */
function vp_newsletter_signature() {
    echo '<p style="text-align:right;"><img src="' . get_template_directory_uri() . '/assets/images/christine-signature.jpg" /></p>';
}
add_action( 'tha_entry_content_after', 'vp_newsletter_signature' );

/**
 * Footer
 *
 */
function vp_newsletter_footer() {

    $news = vp_cf( 'vp_news', get_the_ID(), array( 'cf_type' => 'complex' ) );
    if( $news ) {
        $title = vp_cf( 'vp_news_section_title' );
        if( $title )
            echo '<h2 class="section-header">' . esc_html( $title ) . '</h2>';
        foreach( $news as $i => $item ) {
            echo '<div class="item item-' . $i . '">';
            if( !empty( $item['title'] ) )
                echo '<h4>' . esc_html( $item['title'] ) . '</h4>';
            echo apply_filters( 'vp_the_content', $item['excerpt'] );
            if( !empty( $item['url'] ) )
                echo '<p><a class="button button-orange" href="' . esc_url( $item['url'] ) . '">Read More</a></p>';
            echo '</div>';
        }
    }

    $featured = vp_cf( 'vp_featured', get_the_ID(), array( 'cf_type' => 'complex' ) );
    if( $featured ) {
        $title = vp_cf( 'vp_featured_section_title' );
        if( $title )
            echo '<h2 class="section-header">' . esc_html( $title ) . '</h2>';
        foreach( $featured as $i => $item ) {
            echo '<div class="item item-' . $i . '">';
            if( !empty( $item['title'] ) )
                echo '<h4>' . esc_html( $item['title'] ) . '</h4>';
            echo apply_filters( 'vp_the_content', $item['excerpt'] );
            if( !empty( $item['url'] ) )
                echo '<p><a class="button button-orange" href="' . esc_url( $item['url'] ) . '">Read More</a></p>';
            echo '</div>';
        }
    }

    $qa = vp_cf( 'vp_qa', get_the_ID(), array( 'cf_type' => 'complex' ) );
    if( $qa ) {
        $title = vp_cf( 'vp_qa_section_title' );
        if( $title )
            echo '<h2 class="section-header">' . esc_html( $title ) . '</h2>';
        echo '<div class="item item-0">';
        foreach( $qa as $i => $item ) {
            echo '<div class="question"><span class="label">Q' . ( $i + 1 ) . '.</span>' . apply_filters( 'vp_the_content', $item['question'] ) . '</div>';
            echo '<div class="answer"><span class="label">Ans.</span>' . apply_filters( 'vp_the_content', $item['answer'] ) . '</div>';
        }
        $url = vp_cf( 'vp_qa_url' );
        if( $url )
            echo '<h4 style="margin: 0;"><a href="' . esc_url( $url ) . '">Got A Question?</a></h4>';
        echo '</div>';
    }

    $visa = vp_cf( 'vp_visa_content' );
    if( $visa ) {
        $title = vp_cf( 'vp_visa_section_title' );
        if( $title )
            echo '<h2 class="section-header">' . esc_html( $title ) . '</h2>';
        echo '<div class="item">' . apply_filters( 'vp_the_content', $visa ) . '</div>';
    }

    echo '<div class="item item-1 newsletter-footer">';
    echo vp_social_links_shortcode( array( 'socials' => 'facebook twitter linkedin googleplus', 'style' => 'box' ) );
    echo '<p><a href="' . home_url( 'immigration-newsletter/subscribe' ) . '">Modify</a> your subscription.<br />VisaPro respects your privacy. To learn more, read our <a href="' . home_url( 'about/privacy-policy' ) . '">privacy policy</a>.</p>';
    echo '</div>';
}
add_action( 'tha_entry_bottom', 'vp_newsletter_footer' );

// Build the page
require get_template_directory() . '/index.php';
