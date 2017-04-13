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

 Container::make( 'post_meta', 'How Consultation Works' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/how-consultation-works.php' )
    ->add_tab( 'Content', array(
        Field::make( 'text', 'vp_consultation_section_title', 'Title' ),
        Field::make( 'complex', 'vp_consultation_boxes', 'Boxes' )
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'textarea', 'summary', 'Summary' ),
                Field::make( 'text', 'price', 'Price' ),
                Field::make( 'text', 'button_text', 'Button Text' ),
                Field::make( 'text', 'button_url', 'Button URL' ),
                Field::make( 'text', 'button_info', 'Button Info' )
            ))
    ) )
    ->add_tab( 'Steps', array(
        Field::make( 'text', 'vp_consultation_steps_title', 'Title' ),
        Field::make( 'text', 'vp_consultation_steps_subtitle', 'Subtitle' ),
        Field::make ('complex', 'vp_consultation_steps', 'Steps' )
            ->set_max(3)
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'rich_text', 'content', 'Content' )
            ) ),
        Field::make( 'rich_text', 'vp_consultation_steps_note', 'Note After Steps' )
    ) );
