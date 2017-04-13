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

Container::make( 'post_meta', 'Sidebar' )
   ->show_on_post_type( 'page' )
   ->show_on_template( 'templates/content-sidebar.php' )
   ->add_fields( array(
       Field::make( 'select', 'vp_content_width', 'Content Area Width' )
        ->add_options( array(
            'standard' => 'Standard',
            'narrow' => 'Narrow',
        ) ),
       Field::make( 'rich_text', 'vp_sidebar', 'Sidebar' )
   ) );
