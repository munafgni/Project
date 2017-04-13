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

 Container::make( 'post_meta', 'Thank You, More Information' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/green-thank-you.php' )
    ->add_fields( array(
        Field::make( 'text', 'vp_more_information_title', 'Section Title' ),
        Field::make( 'complex', 'vp_more_information', 'More Information' )
            ->set_max(4)
            ->add_fields( array(
                Field::make( 'image', 'image', 'Image' ),
                Field::make( 'rich_text', 'content', 'Content' ),
                Field::make( 'text', 'link_text', 'Link Text' )->set_width(50),
                Field::make( 'text', 'link_url', 'Link URL' )->set_width(50)
            ))
    ) );
