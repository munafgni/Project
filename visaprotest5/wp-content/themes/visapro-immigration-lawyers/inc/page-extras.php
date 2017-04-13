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
 * Categories on pages
 *
 */
function vp_categories_on_pages() {
    register_taxonomy_for_object_type( 'category', 'page' );
}
add_action( 'init', 'vp_categories_on_pages' );

/**
 * Blog Categories
 *
 */
function vp_blog_categories() {
    $categories = get_terms( 'category', array( 'parent' => false, 'hide_empty' => false, 'orderby' => 'ID' ) );
    if( empty( $categories ) || is_wp_error( $categories ) )
        return;

    $output = array();
    foreach( $categories as $category ) {
        $class = '';
        if( ( is_single() && in_category( $category->slug ) ) || is_category( $category->slug ) )
            $class = ' class="active"';
        $output[] = '<a href="' . get_term_link( $category, 'category' ) . '"' . $class . '>' . $category->name . '</a>';
    }

    echo '<div class="category-listing">';
    echo '<p>' . join( ' | ', $output ) . '</p>';
    echo '</div>';

}

/**
 * Related Articles
 *
 */
function vp_related_articles() {

    $display = false;
    if( is_page() )
        $display = vp_cf( 'vp_display_related_articles' );
    if( is_single() )
        $display = true;

    if( ! apply_filters( 'vp_display_related_articles', $display ) )
        return;

    $cat = false;
    $current = is_singular() ? get_the_ID() : false;

    if( is_singular() ) {
        $cat = vp_first_term( 'category', 'slug' );
    }

    $loop = new WP_Query( array(
        'posts_per_page' => 4,
        'post_type'      => 'page',
        'post_parent'    => 358,
        'category_name'  => $cat,
        'post__not_in'   => array( $current ),
    ) );

    if( ! $loop->have_posts() )
        return;

    echo '<div class="related-articles"><div class="wrap">';
    echo '<h5><a href="' . home_url( 'resources/article' ) . '">Related Articles <i class="icon-chevron-right"></i></a></h5>';

    while( $loop->have_posts() ): $loop->the_post();
        echo '<div class="related-article">';
        echo '<a href="' . get_permalink() . '" class="entry-image-link">' . wp_get_attachment_image( vp_post_image_id(), 'vp_small' ) . '</a>';
        $title = wp_html_excerpt( get_the_title(), 60 );
        if( $title != get_the_title() )
            $title .= '&hellip;';
        echo '<h6><a href="' . get_permalink() . '">' . $title . '</a></h6>';
        echo '</div>';
    endwhile; wp_reset_postdata();
    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_related_articles', 8 );



/**
 * Translate Page
 *
 */
function vp_translate_page() {
    return '<div id="google_translate_element"></div><script type="text/javascript">
    function googleTranslateElementInit() {
      new google.translate.TranslateElement({pageLanguage: \'en\', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: \'UA-197071-2\'}, \'google_translate_element\');
    }
    </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>';

}
