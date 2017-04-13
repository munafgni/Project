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

 Container::make( 'theme_options', 'Theme Options' )

    ->add_tab( 'General', array(
        Field::make( 'text', 'vp_phone', 'Phone Number' ),
        Field::make( 'text', 'vp_login', 'Login URL' ),
        Field::make( 'text', 'vp_facebook', 'Facebook URL' ),
        Field::make( 'text', 'vp_youtube', 'YouTube URL' ),
        Field::make( 'text', 'vp_twitter', 'Twitter URL' ),
        Field::make( 'text', 'vp_googleplus', 'Google+ URL' ),
        Field::make( 'text', 'vp_linkedin', 'LinkedIn URL' ),
        Field::make( 'text', 'vp_feed', 'RSS Feed URL' ),
        Field::make( 'text', 'vp_pinterest', 'Pinterest URL' ),
        Field::make( 'text', 'vp_legal_fee', 'Default Legal Fee' ),
        Field::make( 'image', 'vp_default_post_image', 'Default Post Image' )
    ) )
    ->add_tab( 'Testimonials', array(
        Field::make( 'complex', 'vp_testimonials', 'Testimonials' )
            ->add_fields( array(
                Field::make( 'textarea', 'quote', 'Quote' ),
                Field::make( 'text', 'byline', 'Byline' ),
                Field::make( 'image', 'image', 'Image' ),
            ) )
    ) )
    ->add_tab( 'CTAs', array(
        Field::make( 'separator', 'vp_cta_get_started', 'Get Started' ),
        Field::make( 'text', 'vp_cta_get_started_title', 'Title' )->set_width(33),
        Field::make( 'text', 'vp_cta_get_started_button_text', 'Button Text' )->set_width(33),
        Field::make( 'text', 'vp_cta_get_started_button_url', 'Button URL' )->set_width(33),
        Field::make( 'separator', 'vp_cta_immigration_issues', 'Immigration Issues' ),
        Field::make( 'text', 'vp_cta_immigration_issues_title', 'Title' ),
        Field::make( 'textarea', 'vp_cta_immigration_issues_content', 'Content' ),
        Field::make( 'text', 'vp_cta_immigration_issues_button_text', 'Button Text' )->set_width(50),
        Field::make( 'text', 'vp_cta_immigration_issues_button_url', 'Button URL' )->set_width(50),
        Field::make( 'separator', 'vp_cta_talk_now', 'Talk Now' ),
        Field::make( 'text', 'vp_cta_talk_now_title', 'Title' ),
    ) );
