<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

get_header();

tha_content_before();
echo '<div class="content-area">';

	$classes = apply_filters( 'vp_site_main_class', array( 'site-main' ) );
	echo '<main class="' . implode( ' ', $classes ) . '" role="main">';
	tha_content_top();
	tha_content_loop();
	tha_content_bottom();
	echo '</main>';

echo '</div>';
tha_content_after();

get_sidebar();
get_footer();
