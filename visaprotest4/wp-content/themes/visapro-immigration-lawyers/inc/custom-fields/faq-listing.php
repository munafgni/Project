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

Container::make( 'post_meta', 'FAQ Listing' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/faq-listing.php' )
    ->add_fields( array(
        Field::make( 'text', 'vp_faq_answer_url', 'FAQ Answer URL' ),
        Field::make( 'complex', 'vp_faq', 'FAQ' )
            ->add_fields( array(
                Field::make( 'text', 'title', 'Title' ),
            ))
     ) );

define( 'VP_FAQ_PER_PAGE', 15 );
define( 'VP_FAQ_ANSWERS_PER_PAGE', 5 );
