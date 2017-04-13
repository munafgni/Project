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

Container::make( 'post_meta', 'Consultation' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/consultation.php' )
    ->add_tab( 'Sidebar', array(
        Field::make( 'textarea', 'vp_testimonial', 'Testimonial' )
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
   ->add_tab( 'CTA', array(
       Field::make( 'text', 'vp_cta_text', 'Text' ),
       Field::make( 'text', 'vp_cta_button_text', 'Button Text' ),
       Field::make( 'text', 'vp_cta_button_url', 'Button URL' ),
       Field::make( 'text', 'vp_cta_button_info', 'Button Info' )
   ) );
