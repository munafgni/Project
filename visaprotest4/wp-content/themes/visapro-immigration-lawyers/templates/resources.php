<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Resources */

// Medium Content
add_filter( 'body_class', 'vp_wide_content' );

/**
 * Resource Types
 *
 */
function vp_resource_types() {

    // This template is used on Resources and Resource sub-pages,
    // so find resource page ID.
    $resource_id = is_page( 'resources' ) ? get_the_ID() : wp_get_post_parent_id( get_the_ID() );


    // All the sections are subpages of resources
    $loop = new WP_Query( array(
        'post_type'              => 'page',
        'post_parent'            => $resource_id,
        'orderby'                => 'menu_order',
        'order'                  => 'ASC',
        'posts_per_page'         => 20,
        'fields'                 => 'ids',
    ) );

    if( empty( $loop->posts ) )
        return array();

    $types = array();
    foreach( $loop->posts as $post_id )
        $types[$post_id] = array(
            'id'    => $post_id,
            'title' => get_the_title( $post_id ),
            'slug'  => get_post_field( 'post_name', $post_id ),
        );

    return $types;
}

/**
 * Resources Filters
 *
 */
function vp_resources_filters() {
    echo '<div class="resource-filters">';

        // Resource Type
        if( is_page( 'resources' ) ) {
            echo '<div class="resource-filter">';
            $types = vp_resource_types();
            $current = false;
            $toggle = 'All Resource Types';

            if( isset( $_GET['vp_resource_type'] ) ) {
                foreach( $types as $type ) {
                    if( $type['slug'] == $_GET['vp_resource_type'] ) {
                        $current = $type['slug'];
                        $toggle = $type['title'] . 's';
                    }
                }
            }

            echo '<a class="toggle" href="#">' . $toggle . '</a>';
            echo '<ul>';
            echo '<li class="' . vp_class( 'item', 'active', $current === false ) . '"><a href="' . remove_query_arg( 'vp_resource_type' ) . '">All Resource Types</a></li>';
            foreach( $types as $type ) {
                echo '<li class="' . vp_class( 'item', 'active', $current === $type['slug'] ) . '"><a href="' . add_query_arg( 'vp_resource_type', $type['slug'] ) . '">' . $type['title'] . 's</a></li>';
            }
            echo '</ul>';
            echo '</div>';
        }

        // Resource Topic
        echo '<div class="resource-filter">';
        $current = $current_id = false;
        $toggle = 'All Immigration Topics';

        if( isset( $_GET['vp_resource_topic'] ) ) {
            $category = get_term_by( 'slug', esc_attr( $_GET['vp_resource_topic'] ), 'resource_category' );
            if( $category ) {
                $toggle = $category->name;
                $current = $category->slug;
                $current_id = $category->term_id;
            }

        }

        echo '<a class="toggle" href="#">' . $toggle . '</a>';
        echo '<ul>';
        echo '<li class="' . vp_class( 'item', 'active', $current === false ) . '"><a href="' . remove_query_arg( 'vp_resource_topic' ) . '">All Immigration Topics</a></li>';
        add_filter( 'term_link', 'vp_resource_category_link', 10, 2 );
        wp_list_categories( array(
            'depth' => 2,
            'echo' => true,
            'hide_empty' => false,
            'orderby' => 'name',
            'style' => 'list',
            'title_li' => false,
            'current_category' => $current_id,
            'taxonomy' => 'resource_category',
        ));
        remove_filter( 'term_link', 'vp_resource_category_link', 10, 2 );
        echo '</ul>';
        echo '</div>';
    echo '</div>';
}
add_action( 'tha_entry_top', 'vp_resources_filters', 15 );

/**
 * Resource Category Link
 *
 */
function vp_resource_category_link( $link, $term ) {
    return add_query_arg( 'vp_resource_topic', $term->slug );
}

/**
 * Resources Landing Listing
 *
 */
function vp_resources_listing() {

    if( ! is_page( 'resources' ) )
        return;

    $found_posts = false;
    $sections = vp_resource_types();

    // Limit to one section
    if( isset( $_GET['vp_resource_type'] ) ) {
        $all_sections = $sections;
        $sections = array();
        foreach( $all_sections as $section ) {
            if( $section['slug'] == $_GET['vp_resource_type'] )
                $sections[] = $section;
        }
        if( empty( $sections ) )
            $sections = $all_sections;
    }

    // Limit to one category
    $category_name = false;
    if( isset( $_GET['vp_resource_topic'] ) ) {
        $category = get_term_by( 'slug', esc_attr( $_GET['vp_resource_topic'] ), 'resource_category' );
        if( !empty( $category ) && ! is_wp_error( $category ) )
            $category_name = $category->slug;
    }

    foreach( $sections as $section ) {
        $loop = new WP_Query( array(
            'post_type'              => 'page',
            'post_parent'            => $section['id'],
            'resource_category'      => $category_name,
            'posts_per_page'         => 4,
            'no_found_rows'          => true,
            'update_post_term_cache' => false,
        ) );
        if( $loop->have_posts() ):
            $found_posts = true;
            echo '<div class="resource-listing">';
            echo '<h4>' . $section['title'] . '</h4>';
            while( $loop->have_posts() ): $loop->the_post();
                get_template_part( 'partials/resource' );
            endwhile;
            echo '<p class="more"><a href="' . get_permalink( $section['id'] ) . '" class="button">View More ' . $section['title'] . 's</a></p>';
            echo '</div>';
        endif;
    }

    wp_reset_postdata();

    if( ! $found_posts ) {
        echo '<h4>No Results Found</h4>';
        echo '<p>Please modify your filter selection at the top, or <a href=" '. home_url( 'resources' ) . '">View All Resources</a>.</p>';
    }

}
add_action( 'tha_entry_content_before', 'vp_resources_listing', 40 );
remove_action( 'tha_entry_content_before', 'vp_entry_content', 40 );

/**
 * Resources Section Listing
 *
 */
function vp_resources_section_listing() {

    if( is_page( 'resources' ) )
        return;

    $found_posts = false;
    $sections = get_terms( array(
        'taxonomy' => 'resource_category',
        'parent'   => false,
    ) );

    // Limit to one section
    if( isset( $_GET['vp_resource_topic'] ) ) {
        $category = get_term_by( 'slug', esc_attr( $_GET['vp_resource_topic'] ), 'resource_category' );
        if( !empty( $category ) && ! is_wp_error( $category) )
            $sections = array( $category );
    }

    foreach( $sections as $section ) {
        $loop = new WP_Query( array(
            'post_type'              => 'page',
            'post_parent'            => get_queried_object_id(),
            'resource_category'      => $section->slug,
            'posts_per_page'         => 4,
            'update_post_term_cache' => false,
        ) );
        if( $loop->have_posts() ):
            $found_posts = true;
            echo '<div class="resource-listing">';
            echo '<h4>' . $section->name . '</h4>';
            while( $loop->have_posts() ): $loop->the_post();
                get_template_part( 'partials/resource' );
            endwhile;

            if( $loop->max_num_pages > 1 ) {
                $button_text = 'View ' . $section->name . ' ' . get_the_title( get_queried_object_id() ) . 's';
                echo '<p class="more"><a href="#" class="button resource-load-more" data-resource-type="' . get_queried_object_id() . '" data-resource-topic="' . $section->slug . '" data-resource-page="2">' . $button_text . ' <i class="icon-spinner"></i></a></p>';
            }

            echo '</div>';
        endif;
    }

    wp_reset_postdata();

    if( ! $found_posts ) {
        echo '<h4>No Results Found</h4>';
        echo '<p>Please modify your filter selection at the top, or <a href=" '. home_url( 'resources' ) . '">View All Resources</a>.</p>';
    }


}
add_action( 'tha_entry_content_before', 'vp_resources_section_listing', 40 );

// Build the page
require get_template_directory() . '/index.php';
