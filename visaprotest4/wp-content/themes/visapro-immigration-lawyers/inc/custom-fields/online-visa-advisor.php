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

 Container::make( 'post_meta', 'Steps' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/online-visa-advisor.php' )
    ->add_fields( array(
        Field::make( 'complex', 'vp_steps', 'Steps' )
            ->set_max(3)
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'textarea', 'description', 'Description' ),
                Field::make( 'text', 'button_text', 'Button Text' )->set_width(50),
                Field::make( 'text', 'button_url', 'Button URL' )->set_width(50)
            ) ),
        Field::make( 'complex', 'vp_online_visa_section_nav', 'Section Nav' )
            ->help_text( 'Displayed on subpages' )
            ->set_max(3)
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' )->set_width(50),
                Field::make( 'text', 'url', 'URL' )->set_width(50)
            ) )

    ) );
