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

 Container::make( 'post_meta', 'Post Options' )
    ->show_on_post_type( 'post' )
    ->add_fields( array(
        Field::make( 'select', 'vp_post_format', 'Post Format' )
            ->add_options( array(
                'article' => 'Article',
                'video'   => 'Video',
                'link'    => 'Link',
                'quote'   => 'Quote'
            ) ),
        Field::make( 'text', 'vp_video_url', 'Video URL' )
            ->set_conditional_logic( array( array(
                'field' => 'vp_post_format',
                'value' => 'video',
            ) ) ),
        Field::make( 'text', 'vp_quote_byline', 'Quote Byline' )
        ->set_conditional_logic( array( array(
            'field' => 'vp_post_format',
            'value' => 'quote',
        ) ) ),
        Field::make( 'checkbox', 'vp_display_archive_image', 'Display featured image on archive' )
    ) );
