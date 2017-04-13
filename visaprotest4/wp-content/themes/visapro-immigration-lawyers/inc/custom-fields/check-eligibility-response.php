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

Container::make( 'post_meta', 'Check Eligibility Response' )
     ->show_on_post_type( 'page' )
     ->show_on_template( 'templates/check-eligibility-response.php' )
     ->add_tab( 'Message', array(
         Field::make( 'rich_text', 'vp_eligibility_message', 'Message' ),
     ) )
     ->add_tab( 'Bottom Left', array(
        Field::make( 'rich_text', 'vp_eligibility_bottom_left', 'Content' )
     ) )
     ->add_tab( 'Bottom Right', array(
         Field::make( 'rich_text', 'vp_eligibility_bottom_right', 'Content' )
     ) );
