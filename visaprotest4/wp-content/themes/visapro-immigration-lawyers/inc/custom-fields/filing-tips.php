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

 Container::make( 'post_meta', 'Filing Tips' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/filing-tips.php' )
    ->add_fields( array(
        Field::make( 'complex', 'fp_tip_links', 'Extra Links' )
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' )->set_width( 50 ),
                Field::make( 'text', 'url', 'URL' )->set_width( 50 )
            ))
    ) );
