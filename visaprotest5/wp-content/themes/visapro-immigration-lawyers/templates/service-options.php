<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Service Options */

// Content Sidebar layout
add_filter( 'vp_page_layout', 'vp_return_content_sidebar' );

/**
 * Page Header
 *
 */
function vp_service_options_page_header() {
    echo '<div class="page-header">';
    vp_entry_title();
    vp_entry_subtitle();
    vp_entry_header_text();
    echo '</div>';
}
add_action( 'tha_content_before', 'vp_service_options_page_header' );
remove_action( 'tha_entry_top', 'vp_entry_title' );
remove_action( 'tha_entry_top', 'vp_entry_subtitle', 12 );
remove_action( 'tha_entry_top', 'vp_entry_header_text', 13 );

/**
 * Tabbed Content
 *
 */
function vp_service_options_tabbed_content() {
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
add_action( 'tha_entry_after', 'vp_service_options_tabbed_content' );


/**
 * Sidebar
 *
 */
function vp_service_options_sidebar(){
    echo '<h4>What VisaPro<br />Customers Are Saying</h4>';
    echo apply_filters( 'vp_the_content', vp_stars() . vp_cf( 'vp_testimonial' ) );
}
add_action( 'tha_sidebar_top', 'vp_service_options_sidebar' );

/**
 * Service Listing
 *
 */
function vp_service_options_listing() {
    echo '<div class="service-listing"><div class="wrap">';
    vp_cf( 'vp_service_section_title', false, array( 'echo' => true, 'escape' => 'esc_html', 'prepend' => '<h4 class="large">', 'append' => '</h4>' ) );
    vp_cf( 'vp_service_section_subtitle', false, array( 'echo' => true, 'escape' => 'esc_html', 'prepend' => '<h5>', 'append' => '</h5>' ) );

    $services = vp_cf( 'vp_services', false, array( 'cf_type' => 'complex' ) );
    foreach( $services as $i => $service ) {
        echo '<div class="service service-' . $i . '">';
        echo '<h5>' . esc_html( $service['title'] ) . '</h5>';
        echo '<ul>';
        foreach( $service['features'] as $j => $feature ) {
            $class = 'feature-' . $j;
            $text = '<span>' . esc_html( $feature['feature'] ) . '</span>';
            if( '<span>-</span>' == $text )
                $class .= ' empty';
            echo '<li class="' . $class . '">' . $text . '</li>';
        }
        echo '</ul>';
        echo '<p class="more"><a href="' . esc_url( $service['get_started_url'] ) . '" class="button">Get Started Now</a></p>';
        echo '</div>';
    }
    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_service_options_listing', 5 );

// Build the page
require get_template_directory() . '/index.php';
