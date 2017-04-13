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

 Container::make( 'post_meta', 'Service Options' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/service-options.php' )
    ->add_tab( 'Tabbed Content', array(
        Field::make( 'complex', 'vp_tabs', 'Tabs' )
            ->set_max(3)
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'rich_text', 'content', 'Content' ),
            ) )
    ) )
    ->add_tab( 'Sidebar', array(
        Field::make( 'textarea', 'vp_testimonial', 'Testimonial' )
    ) )
    ->add_tab( 'Services', array(
        Field::make( 'text', 'vp_service_section_title', 'Service Section Title' ),
        Field::make( 'text', 'vp_service_section_subtitle', 'Service Section Subtitle' ),
        Field::make( 'complex', 'vp_services', 'Services' )
            ->set_layout( 'tabbed-vertical' )
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'complex', 'features', 'Features' )
                    ->add_fields( array(
                        Field::make( 'text', 'feature', 'Feature' )
                    ) ),
                Field::make( 'text', 'get_started_url', 'Get Started URL' )
            ))
    ) );
