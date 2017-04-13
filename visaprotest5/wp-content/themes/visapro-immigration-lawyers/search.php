<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

/**
 * Search Header
 *
 */
function vp_search_header() {

    echo '<div class="search-header">';
    echo '<h1 class="archive-title">Search VisaPro.com</h1>';
    get_search_form();
    echo '<p>Search Results for <strong>"' . get_search_query() . '"</strong></p>';
    echo '</div>';
}
add_action( 'tha_content_top', 'vp_search_header' );

/**
 * Search Content
 *
 */
function vp_search_content() {
    echo '<gcse:searchresults-only newWindow="false" queryParameterName="s"></gcse:searchresults-only>';
}
add_action( 'tha_content_loop', 'vp_search_content' );
remove_action( 'tha_content_loop', 'vp_default_loop' );

// Build the page
require get_template_directory() . '/index.php';
