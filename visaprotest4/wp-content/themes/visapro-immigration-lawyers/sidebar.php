<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

if( ! function_exists( 'vp_page_layout' ) )
	return;

$layout = vp_page_layout();
if( ! in_array( $layout, array( 'content-sidebar', 'sidebar-content' ) ) )
	return;

tha_sidebars_before();
echo '<aside class="sidebar-primary" role="complementary">';
	tha_sidebar_top();
	tha_sidebar_bottom();
echo '</aside>';
tha_sidebars_after();
