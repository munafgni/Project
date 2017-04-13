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
 * Resource Category
 *
 */
function vp_register_resource_category() {

    $labels = array(
        'name'                       => 'Resource Category',
        'singular_name'              => 'Category',
        'search_items'               => 'Search Categories',
        'popular_items'              => 'Popular Categories',
        'all_items'                  => 'All Categories',
        'parent_item'                => 'Parent Category',
        'parent_item_colon'          => 'Parent Category:',
        'edit_item'                  => 'Edit Category',
        'update_item'                => 'Update Category',
        'add_new_item'               => 'Add New Category',
        'new_item_name'              => 'New Category',
        'separate_items_with_commas' => 'Separate Categories with commas',
        'add_or_remove_items'        => 'Add or remove Categories',
        'choose_from_most_used'      => 'Choose from most used Categories',
        'menu_name'                  => 'Resource Categories',
    );
    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_in_nav_menus' => false,
        'show_ui'           => true,
        'show_tagcloud'     => false,
        'hierarchical'      => true,
        'rewrite'           => false,
        'query_var'         => true,
        'show_admin_column' => false,
        // 'meta_box_cb'    => false,
    );
    register_taxonomy( 'resource_category', array( 'page' ), $args );
}
add_action( 'init', 'vp_register_resource_category' );

/**
 * Remove Resource Category metabox
 *
 */
function vp_remove_resource_category_metabox() {

    $screen = get_current_screen();
    if( 'page' !== $screen->id || ! isset( $_GET['post']) )
        return;
    $post_id = intval( $_GET['post'] );
    $ancestors = get_ancestors( $post_id, 'page', 'post_type' );

    if( ! in_array( 11, $ancestors ) ) {
        remove_meta_box( 'resource_categorydiv', 'page', 'side' );
    }

}
add_action( 'admin_head', 'vp_remove_resource_category_metabox' );


/**
 * Resource AJAX Request
 *
 */
function vp_resource_load_more() {

    $loop = new WP_Query( array(
        'post_type'              => 'page',
        'post_parent'            => intval( $_POST['vp_resource_type'] ),
        'resource_category'      => esc_attr( $_POST['vp_resource_topic'] ),
        'posts_per_page'         => 4,
        'paged'                  => intval( $_POST['vp_resource_page'] ),
        'update_post_term_cache' => false,
    ) );

    ob_start();
    if( $loop->have_posts() ):
        while( $loop->have_posts() ): $loop->the_post();
            get_template_part( 'partials/resource' );
        endwhile;
    else:
        echo '<p>No results found</p>';
    endif;

    if( $loop->max_num_pages > intval( $_POST['vp_resource_page'] ) ) {
        echo '<p class="more"><a href="#" class="button resource-load-more" data-resource-type="' . intval( $_POST['vp_resource_type'] ) . '" data-resource-topic="' . esc_attr( $_POST['vp_resource_topic'] ) . '" data-resource-page="' . ( intval( $_POST['vp_resource_page'] ) + 1 ) . '">' . esc_html( $_POST['vp_resource_button_text'] ) . ' <i class="icon-spinner"></i></a></p>';
    }

    $data = ob_get_clean();
    wp_send_json_success( $data );
    wp_die();
}
add_action( 'wp_ajax_vp_resource_load_more', 'vp_resource_load_more' );
add_action( 'wp_ajax_nopriv_vp_resource_load_more', 'vp_resource_load_more' );
