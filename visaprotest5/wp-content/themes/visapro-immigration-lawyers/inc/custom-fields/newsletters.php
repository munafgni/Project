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

 Container::make( 'post_meta', 'Newsletters' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/newsletters.php' )
    ->add_fields( array(
        Field::make( 'complex', 'fp_newsletter_years', 'Years' )
            ->setup_labels( array(
                'plural_name'   => 'Years',
                'singular_name' => 'Year',
            ) )
            ->add_fields( array(
                Field::make( 'text', 'year', 'Year' ),
                Field::make( 'complex', 'newsletters', 'Newsletters' )
                    ->setup_labels( array(
                        'plural_name'   => 'Newsletters',
                        'singular_name' => 'Newsletter',
                    ) )
                    ->add_fields( array(
                        Field::make( 'text', 'month', 'Month' )->set_width(50),
                        Field::make( 'text', 'url', 'URL' )->set_width(50)
                    ) )
            ))
    ) );
