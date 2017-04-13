<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/* Template Name: Wide Content */

add_filter( 'body_class', 'vp_wide_content' );


// Build the page
require get_template_directory() . '/index.php';
