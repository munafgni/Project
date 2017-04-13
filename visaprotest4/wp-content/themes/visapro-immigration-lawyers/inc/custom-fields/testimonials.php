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

 Container::make( 'post_meta', 'Testimonials' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/testimonials.php' )
    ->add_fields( array(
        Field::make( 'complex', 'vp_testimonials', 'Testimonials' )
            ->add_fields( array(
                Field::make( 'rich_text', 'quote', 'Quote' ),
                Field::make( 'text', 'name', 'Name' )->set_width(50),
                Field::make( 'text', 'location', 'Location' )->set_width(50),
                Field::make( 'image', 'image', 'Visa Graphic' )
            ) )
    ) );
