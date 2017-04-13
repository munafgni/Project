<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Dictionary Landing */

// Wide Content
add_filter( 'body_class', 'vp_wide_content' );

// Dictionary Nav
add_action( 'tha_entry_top', 'vp_dictionary_nav', 20 );

// Build the page
require get_template_directory() . '/index.php';
