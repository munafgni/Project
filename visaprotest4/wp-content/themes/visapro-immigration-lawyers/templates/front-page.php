<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Front Page */

// Wide Content
add_filter( 'body_class', 'vp_wide_content' );

// Remove Breadcrumbs
remove_action( 'tha_header_after', 'vp_breadcrumbs' );

/**
 * Content
 *
 */
function vp_home_content() {
    $list = vp_cf( 'vp_page_header_checks', false, array( 'cf_type' => 'complex' ) );
    if( !empty( $list ) ) {
        echo '<ul class="checks check-smaller blue">';
        foreach( $list as $i => $list_item ) {
            echo '<li class="' . vp_column_class( 2, $i ) . '">' . esc_html( $list_item['item'] ) . '</li>';
        }
        echo '</ul>';
    }

    echo '<div class="buttons">';
        echo '<div class="button-section">';
            echo '<a class="button button-block" href="' . esc_url( vp_cf( 'vp_home_button1_url' ) ) . '">' . esc_html( vp_cf( 'vp_home_button1_text' ) ) . '</a>';
            echo '<span class="button-info">' . esc_html( vp_cf( 'vp_home_button1_info' ) ) . '</span>';
        echo '</div>';
        echo '<span class="or">OR</span>';
        echo '<div class="button-section">';
            echo '<a class="button button-outline button-block" href="' . esc_url( vp_cf( 'vp_home_button2_url' ) ) . '">' . esc_html( vp_cf( 'vp_home_button2_text' ) ) . '</a>';
            echo '<span class="button-info">' . esc_html( vp_cf( 'vp_home_button2_info' ) ) . '</span>';
        echo '</div>';
    echo '</div>';

}
add_action( 'tha_entry_content_before', 'vp_home_content', 40 );
remove_action( 'tha_entry_content_before', 'vp_entry_content', 40 );

/**
 * Options
 *
 */
function vp_home_options() {
    echo '<div class="home-options"><div class="wrap">';
    vp_cf( 'vp_home_options_title', get_the_ID(), array( 'echo' => true, 'prepend' => '<h2>', 'append' => '</h2>' ) );
    echo apply_filters( 'vp_the_content', vp_cf( 'vp_home_options_content' ) );
    $options = vp_cf( 'vp_home_options', get_the_ID(), array( 'cf_type' => 'complex' ) );
    if( $options ) {
        echo '<div class="options-container">';
        foreach( $options as $i => $option ) {
            echo '<div class="option">';
                echo '<h5>' . $option['title'] . '</h5>';
                echo '<div class="summary">' . apply_filters( 'vp_the_content', $option['content'] ) . '</div>';
                echo '<a href="' . esc_url( $option['button_url'] ) . '" class="' . vp_class( 'button button-block', 'button-outline', $i % 2 == 0 ) . '">' . esc_html( $option['button_text'] ) . '</a>';
                echo '<p class="disclaimer">' . esc_html( $option['button_info'] ) . '</p>';
            echo '</div>';
        }
        echo '</div>';
    }
    echo '</div></div>';

}
add_action( 'tha_footer_before', 'vp_home_options', 5 );

/**
 * Success Story Listing
 *
 */
function vp_home_success_stories() {
    echo '<div class="success-stories"><div class="wrap">';
    vp_cf( 'vp_success_story_section_subtitle', false, array( 'echo' => true, 'escape' => 'esc_html', 'prepend' => '<p class="subtitle">', 'append' => '</p>' ) );
    vp_cf( 'vp_success_story_section_title', false, array( 'echo' => true, 'prepend' => '<h2>', 'append' => '</h2>' ) );

    $stories = vp_cf( 'vp_success_stories', false, array( 'cf_type' => 'complex' ) );
    foreach( $stories as $i => $story ) {
        echo '<div class="success-story">';
        if( !empty( $story['image'] ) )
            echo '<p>' . wp_get_attachment_image( intval( $story['image'] ), 'thumbnail', null, array( 'class' => 'aligncenter' ) ) . '</p>';
        if( !empty( $story['title'] ) )
            echo '<h5>' . esc_html( $story['title'] ) . '</h5>';
        echo '<p class="summary">' . $story['summary'] . '</p>';
        if( !empty( $story['url'] ) )
            echo '<p class="more"><a href="' . esc_url( $story['url'] ) . '">Read Full Success Story <i class="icon-angle-double-right"></i></a></p>';
        echo '</div>';
    }

    $logos = vp_cf( 'vp_customer_logos' );
    if( $logos ) {
        echo '<div class="customer-logos">';
        echo '<h5><span>Customers Using VisaPro</span></h5>';
        echo wp_get_attachment_image( $logos, 'full', null, array( 'class' => 'aligncenter' ) );
        echo '</div>';
    }
    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_home_success_stories', 5 );

/**
 * About You
 *
 */
function vp_home_about_you() {
    echo '<div class="about-you"><div class="wrap">';
    vp_cf( 'vp_home_about_title', get_the_ID(), array( 'prepend' => '<h2>', 'append' => '</h2>', 'echo' => true ) );

    $boxes = vp_cf( 'vp_home_about_boxes', get_the_ID(), array( 'cf_type' => 'complex' ) );
    foreach( $boxes as $i => $box ) {
        echo '<div class="about-box">';
            echo '<div class="col">';
                echo '<h4>' . esc_html( $box['title1'] ) . '</h4>';
                echo apply_filters( 'vp_the_content', $box['content1'] );
            echo '</div>';
            echo '<div class="col">';
                echo '<h4>' . esc_html( $box['title2'] ) . '</h4>';
                echo apply_filters( 'vp_the_content', $box['content2'] );
            echo '</div>';
            echo '<div class="cta">';
                echo '<div class="button-wrapper">';
                    echo '<a href="' . esc_url( $box['button_url'] ) . '" class="' . vp_class( 'button button-block', 'button-orange', $i == 1 ) . '">' . esc_html( $box['button_text'] ) . '</a>';
                    echo '<span class="button-info">' . esc_html( $box['button_info'] ) . '</span>';
                echo '</div>';
                echo '<div class="learn-more">OR <a href="' . esc_url( $box['learn_more'] ) . '">Learn More</a></div>';
            echo '</div>';
        echo '</div>';
    }
    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_home_about_you', 5 );

/**
 * Home Testimonials
 *
 */
function vp_home_testimonials() {
    $testimonials = vp_cf( 'vp_testimonials', false, array( 'type' => 'theme_option', 'cf_type' => 'complex' ) );
    if( empty( $testimonials ) )
        return;

    echo '<div class="home-testimonials"><div class="wrap">';
    echo '<h2 style="text-align:center;">What VisaPro Customers Are Saying</h2>';

    echo '<div class="testimonial-carousel slick-slider">';
    foreach( $testimonials as $testimonial ) {
        echo '<div class="item">';

        if( !empty( $testimonial['image'] ) )
            echo wp_get_attachment_image( intval( $testimonial['image'] ), 'thumbnail', null, array( 'class' => 'avatar no-border' ) );
        echo '<p>' . vp_stars() . esc_html( $testimonial['quote'] ) . '</p>';
        if( !empty( $testimonial['byline'] ) )
            echo '<p class="byline">' . esc_html( $testimonial['byline'] ) . '</p>';
        echo '</div>';
    }
    echo '</div>';
    echo '<div class="carousel-nav"></div>';

    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_home_testimonials', 5 );

/**
 * Home Visas
 *
 */
function vp_home_visas() {
    echo '<div class="home-visas"><div class="wrap">';
    vp_cf( 'vp_home_visas_title', get_the_ID(), array( 'echo' => true, 'prepend' => '<h2>', 'append' => '</h2>' ) );
    $visas = vp_cf( 'vp_home_visas', get_the_ID(), array( 'cf_type' => 'complex' ) );
    foreach( $visas as $visa ) {
        echo '<div class="visa">';
            echo '<h5><a href="' . esc_url( $visa['url'] ) . '">' . esc_html( $visa['title'] ) . ' <i class="icon-angle-double-right"></i></a></h5>';
            echo '<p>' . esc_html( $visa['summary'] ) . '</p>';
        echo '</div>';
    }
    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_home_visas', 5 );

/**
 * Home Resources
 *
 */
function vp_home_resources() {
    echo '<div class="home-resources"><div class="wrap">';

    echo '<div class="section-header">';
    vp_cf( 'vp_home_resources_title', get_the_ID(), array( 'echo' => true, 'prepend' => '<h2>', 'append' => '</h2>' ) );
    vp_cf( 'vp_home_resources_subtitle', get_the_ID(), array( 'echo' => true, 'prepend' => '<h5>', 'append' => '</h5>' ) );
    echo '</div>';

    $loop = new WP_Query( array(
        'post_type'              => 'page',
        'posts_per_page'         => 4,
        'post_parent__in'        => vp_resource_page_ids(),
        'no_found_rows'          => true,
        'update_post_term_cache' => false,
    ) );

    echo '<div class="section-content">';
    if( $loop->have_posts() ): while( $loop->have_posts() ): $loop->the_post();
        $type = wp_get_post_parent_id( get_the_ID() );
        echo '<div class="resource">';
        echo '<h5>' . get_the_title( $type ) . '</h5>';
        echo '<a href="' . get_permalink() . '" class="entry-image-link">' . wp_get_attachment_image( vp_post_image_id(), 'vp_small' ) . '</a>';
        echo '<a href="' . get_permalink() . '" class="entry-title">' . get_the_title() . '</a>';
        echo '<a class="more" href="' . get_permalink( $type ) . '">All ' . get_the_title( $type ) . 's <i class="icon-angle-double-right"></i></a>';
        echo '</div>';
    endwhile; endif; wp_reset_postdata();
    echo '</div>';

    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_home_resources', 5 );

// Build the page
require get_template_directory() . '/index.php';
