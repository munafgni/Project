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

Container::make( 'post_meta', 'FAQ Answers' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/faq-answers.php' )
    ->add_fields( array(
         Field::make( 'complex', 'vp_faq_answers', 'FAQ Answers' )
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'rich_text', 'content', 'Content' ),
            ))
     ) );
