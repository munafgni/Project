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

 Container::make( 'post_meta', 'Listing' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/two-column-number-listing.php' )
    ->add_fields( array(
        Field::make( 'complex', 'vp_listing', 'Listing Items' )
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'text', 'subtitle', 'Subtitle' ),
                Field::make( 'text', 'url', 'URL' ),
            ) )
    ) );
