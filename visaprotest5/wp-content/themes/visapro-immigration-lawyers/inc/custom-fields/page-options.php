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

 Container::make( 'post_meta', 'Page Options' )
    ->show_on_post_type( 'page' )
    ->hide_on_template( 'templates/filing-tip.php' )
    ->hide_on_template( 'templates/dictionary.php' )
    ->hide_on_template( 'templates/immigration-lawyer-consultation.php' )
    ->hide_on_template( 'templates/front-page.php' )
    ->add_fields( array(
        Field::make( 'text', 'vp_page_title', 'Alternative Page Title' ),
        Field::make( 'text', 'vp_page_subtitle', 'Subtitle' ),
        Field::make( 'text', 'vp_page_header_text', 'Additional Text' ),
        Field::make( 'checkbox', 'vp_display_related_articles', 'Display Related Articles' ),
        Field::make( 'checkbox', 'vp_hide_breadcrumbs', 'Hide Breadcrumbs' )
    ) );
