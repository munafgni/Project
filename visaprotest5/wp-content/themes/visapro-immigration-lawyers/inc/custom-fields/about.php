<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

 use Carbon_Fields\Container;
 use Carbon_Fields\Field;

  Container::make( 'post_meta', 'Section Menu' )
     ->show_on_post_type( 'page' )
     ->show_on_page( 'about' )
     ->add_fields( array(
         Field::make( 'checkbox', 'vp_include_section_nav', 'Include Section Navigation' ),
         Field::make( 'complex', 'vp_section_nav', 'Section Navigation' )
             ->add_fields( array(
                 Field::make( 'text', 'title', 'Title' )->set_width(50),
                 Field::make( 'text', 'url', 'URL' )->set_width(50)
             ) )
     ) );

Container::make( 'post_meta', 'Hide Section Menu' )
    ->show_on_post_type( 'page' )
    ->show_on_level(2)
    ->add_fields( array(
        Field::make( 'checkbox', 'vp_exclude_section_nav', 'Remove Section Navigation from this page' )
    ) );

/**
 * Limit to About Pages
 *
 */
function vp_section_menu_metabox_display() {

    $screen = get_current_screen();
    if( 'page' !== $screen->id || ! isset( $_GET['post']) )
        return;
    $post_id = intval( $_GET['post'] );

    $ancestors = get_ancestors( $post_id, 'page', 'post_type' );
    if( !in_array( 55, $ancestors ) ) {
        remove_meta_box( 'HideSectionMenu', 'page', 'normal' );
    }

}
add_action( 'admin_head', 'vp_section_menu_metabox_display' );
