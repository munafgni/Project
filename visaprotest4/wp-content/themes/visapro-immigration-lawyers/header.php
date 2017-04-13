<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

echo '<!DOCTYPE html>';
tha_html_before();
echo '<html ' . get_language_attributes() . '>';

echo '<head>';
	tha_head_top();
	wp_head();
	tha_head_bottom();
echo '</head>';
echo '<body class="' . join( ' ', get_body_class() ) . '">';
tha_body_top();
echo '<div class="site-container">';
	echo '<a class="skip-link screen-reader-text" href="#main-content">' . esc_html__( 'Skip to content', 'ea' ) . '</a>';

	tha_header_before();
	echo '<header class="site-header" role="banner"><div class="wrap">';
		tha_header_top();
		echo '<a class="site-title" href="' . esc_url( home_url() ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a>';
		tha_header_bottom();
	echo '</div></header>';
	tha_header_after();

echo '<div class="site-inner">';
if( apply_filters( 'vp_site_inner_wrap', true ) )
	echo '<div class="wrap">';
