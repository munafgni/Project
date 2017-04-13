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

  Container::make( 'post_meta', 'Ebook' )
     ->show_on_post_type( 'page' )
     ->show_on_template( 'templates/ebook.php' )
     ->add_fields( array(
         Field::make( 'text', 'vp_ebook_thank_you_url', 'Thank You Page URL' )
     ) );
