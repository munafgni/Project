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

 Container::make( 'post_meta', 'Immigration Lawyer Consultation' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/immigration-lawyer-consultation.php' )
    ->add_tab( 'Page Header', array(
        Field::make( 'text', 'vp_page_title', 'Title' ),
        Field::make( 'text', 'vp_page_subtitle', 'Subtitle' ),
        Field::make( 'text', 'vp_page_header_text', 'Additional Text' ),
        Field::make( 'complex', 'vp_page_header_checks', 'Checkmark List' )
            ->add_fields( array(
                Field::make( 'text', 'item', 'Item' )
            ) ),
        Field::make( 'text', 'vp_immigration_consult_intro', 'Online Consultation Pricing' )->set_width(50),
        Field::make( 'text', 'vp_immigration_learn_more', 'Learn More URL' )->set_width(50),
        Field::make( 'text', 'vp_immigration_consult_text', 'Online Consultation Button Text' )->set_width(50),
        Field::make( 'text', 'vp_immigration_consult_url', 'Online Consultation Button URL' )->set_width(50)
    ) )
    ->add_tab( 'Page Content', array(
        Field::make( 'rich_text', 'vp_immigration_content', 'Content' ),
        Field::make( 'complex', 'vp_boxes', 'Boxes' )
            ->set_max( 2 )
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'rich_text', 'content', 'Content' ),
                Field::make( 'text', 'pricing', 'Pricing' )->set_width(50),
                Field::make( 'text', 'learn_more', 'Learn More URL' )->set_width(50),
                Field::make( 'text', 'button_text', 'Button Text' )->set_width(50),
                Field::make( 'text', 'button_url', 'Button URL' )->set_width(50)
            ) )
    ) )
    ->add_tab( 'Testimonial', array(
        Field::make( 'rich_text', 'vp_immigration_testimonial', 'Testimonial' )
    ) );
