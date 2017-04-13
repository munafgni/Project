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

  Container::make( 'post_meta', 'Dictionary' )
     ->show_on_post_type( 'page' )
     ->show_on_template( 'templates/dictionary.php' )
     ->add_fields( array(
         Field::make( 'complex', 'vp_dictionary', 'Dictionary Items' )
            ->add_fields( array(
                Field::make( 'text', 'term', 'Term' )->set_width(50),
                Field::make( 'text', 'url', 'URL' )->set_width(50),
                Field::make( 'rich_text', 'definition', 'Definition' )
            ) )
     ) );
