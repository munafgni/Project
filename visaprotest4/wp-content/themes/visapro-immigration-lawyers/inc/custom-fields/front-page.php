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

 Container::make( 'post_meta', 'Home Content' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/front-page.php' )
    ->add_tab( 'Header', array(
        Field::make( 'text', 'vp_page_title', 'Title' ),
        Field::make( 'text', 'vp_page_subtitle', 'Subtitle' ),
        Field::make( 'text', 'vp_page_header_text', 'Additional Text' ),
        Field::make( 'complex', 'vp_page_header_checks', 'Checkmark List' )
            ->add_fields( array(
                Field::make( 'text', 'item', 'Item' )
            ) ),
        Field::make( 'text', 'vp_home_button1_text', 'Button 1 Text' )->set_width(33),
        Field::make( 'text', 'vp_home_button1_url', 'Button 1 URL' )->set_width(33),
        Field::make( 'text', 'vp_home_button1_info', 'Button 1 Info' )->set_width(33),
        Field::make( 'text', 'vp_home_button2_text', 'Button 2 Text' )->set_width(33),
        Field::make( 'text', 'vp_home_button2_url', 'Button 2 URL' )->set_width(33),
        Field::make( 'text', 'vp_home_button2_info', 'Button 2 Info' )->set_width(33),
    ) )
    ->add_tab( 'Options', array(
        Field::make( 'text', 'vp_home_options_title', 'Title' ),
        Field::make( 'rich_text', 'vp_home_options_content', 'Content' ),
        Field::make( 'complex', 'vp_home_options', 'Options' )
            ->set_max(3)
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'rich_text', 'content', 'Content' ),
                Field::make( 'text', 'button_text', 'Button Text' )->set_width(33),
                Field::make( 'text', 'button_url', 'Button URL' )->set_width(33),
                Field::make( 'text', 'button_info', 'Button Info' )->set_width(33)
            ))
    ) )
    ->add_tab( 'Success Stories', array(
        Field::make( 'text', 'vp_success_story_section_subtitle', 'Subtitle' ),
        Field::make( 'text', 'vp_success_story_section_title', 'Title' ),
        Field::make( 'complex', 'vp_success_stories', 'Success Stories' )
            ->set_max( 3 )
            ->add_fields( array(
                Field::make( 'image', 'image', 'Image' ),
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'textarea', 'summary', 'Summary' ),
                Field::make( 'text', 'url', 'URL' )
            ) ),
        Field::make( 'image', 'vp_customer_logos', 'Customer Logos' )
   ) )
   ->add_tab( 'About You', array(
       Field::make( 'text', 'vp_home_about_title', 'Title' ),
       Field::make( 'complex', 'vp_home_about_boxes', 'Boxes' )
            ->set_max(2)
            ->set_layout('tabbed-vertical')
            ->add_fields( array(
                Field::make( 'text', 'title1', 'Title 1' ),
                Field::make( 'rich_text', 'content1', 'Content 1' ),
                Field::make( 'text', 'title2', 'Title 2' ),
                Field::make( 'rich_text', 'content2', 'Content 2' ),
                Field::make( 'text', 'button_text', 'Button Text' )->set_width(50),
                Field::make( 'text', 'button_url', 'Button URL' )->set_width(50),
                Field::make( 'text', 'button_info', 'Button Info' )->set_width(50),
                Field::make( 'text', 'learn_more', 'Learn More URL' )->set_width(50)
            ))
   ) )
   ->add_tab( 'Popular Visas', array(
       Field::make( 'text', 'vp_home_visas_title', 'Title' ),
       Field::make( 'complex', 'vp_home_visas', 'Visas' )
            ->set_max(5)
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'text', 'url', 'URL' ),
                Field::make( 'textarea', 'summary', 'Summary' )
            ))
   ))
   ->add_tab( 'Resources', array(
       Field::make( 'text', 'vp_home_resources_title', 'Title' ),
       Field::make( 'text', 'vp_home_resources_subtitle', 'Subtitle' )
   ));
