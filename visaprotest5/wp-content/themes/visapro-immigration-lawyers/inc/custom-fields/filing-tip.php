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

 Container::make( 'post_meta', 'Filing Tip' )
    ->show_on_post_type( 'page' )
    ->show_on_template( 'templates/filing-tip.php' )
    ->add_fields( array(
        Field::make( 'text', 'vp_tip_short_title', 'Short Title' ),
        Field::make( 'text', 'vp_tip_long_title', 'Long Title' ),
        Field::make( 'text', 'vp_tip_content', 'Content' )
    ) );
