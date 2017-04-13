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

 Container::make( 'post_meta', 'Thank You Settings' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/thank-you.php' )
    ->add_fields( array(
        Field::make( 'checkbox', 'vp_thank_you_remove_title', 'Remove Page Title' ),
        Field::make( 'rich_text', 'vp_thank_you_intro', 'Intro Box' ),
        Field::make( 'select', 'vp_thank_you_layout', 'Layout' )
            ->add_options( array(
                'full_width_content' => 'Content',
                'content_sidebar'    => 'Content and Sidebar',
            ) ),
        Field::make( 'rich_text', 'vp_thank_you_sidebar', 'Sidebar' )
            ->set_conditional_logic( array(
                array(
                    'field' => 'vp_thank_you_layout',
                    'value' => 'content_sidebar'
                )
            )),
        Field::make( 'text', 'vp_ebook_thank_you_url', 'Form Thank You URL' )
            ->set_conditional_logic( array(
                array(
                    'field' => 'vp_thank_you_layout',
                    'value' => 'content_sidebar'
                )
            ))
    ) );
