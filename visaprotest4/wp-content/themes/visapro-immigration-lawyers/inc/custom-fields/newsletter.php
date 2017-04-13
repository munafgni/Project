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

 Container::make( 'post_meta', 'Newsletter Extras' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/newsletter.php' )
    ->add_tab( 'News', array(
        Field::make( 'text', 'vp_news_section_title', 'Section Title' )
            ->set_default_value( 'Latest Immigration News' ),
        Field::make( 'complex', 'vp_news', 'News Items' )
            ->set_max(3)
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'rich_text', 'excerpt', 'Excerpt' ),
                Field::make( 'text', 'url', 'URL' )
            ) )
    ) )
    ->add_tab( 'Featured Articles', array(
        Field::make( 'text', 'vp_featured_section_title', 'Section Title' )
            ->set_default_value( 'January\'s Featured Articles' ),
        Field::make( 'complex', 'vp_featured', 'Featred Articles' )
            ->set_max(3)
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
                Field::make( 'rich_text', 'excerpt', 'Excerpt' ),
                Field::make( 'text', 'url', 'URL' )
            ) )
    ) )
    ->add_tab( 'Questions and Answers', array(
        Field::make( 'text', 'vp_qa_section_title', 'Section Title' )
            ->set_default_value( 'Questions and Answers' ),
        Field::make( 'complex', 'vp_qa', 'Questions and Answers' )
            ->set_max(3)
            ->add_fields( array(
                Field::make( 'rich_text', 'question', 'Question' ),
                Field::make( 'rich_text', 'answer', 'Answer' )
            ) ),
        Field::make( 'text', 'vp_qa_url', 'Got a Question URL' )
    ) )
    ->add_tab( 'Visa Eligibility', array(
        Field::make( 'text', 'vp_visa_section_title', 'Section Title' )
            ->set_default_value( 'Visa Eligibility Tool' ),
        Field::make( 'rich_text', 'vp_visa_content', 'Content' )
    ) );
