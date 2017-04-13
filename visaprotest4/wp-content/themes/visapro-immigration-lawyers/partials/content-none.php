<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

echo '<section class="no-results not-found">';

	if( is_search() ) {

		echo '<header class="entry-header"><h1 class="entry-title">' . esc_html__( 'Nothing Found', 'ea' ) . '</h1></header>';
		echo '<div class="entry-content">';
		echo '<p>' . esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ea' ) . '</p>';
		get_search_form();
		echo '</div>';

	} else {

		echo '<div class="entry-content">';
		echo '<h4>Possible Reasons:</h4>
		    <ol>
		    <li>It is possible that the webpage you requested is available in the member only area. Please log in to access the page you requested.</li>
		    <li>It is possible you typed the address incorrectly, or that the page no longer exists. As an option, you may visit any of the pages below or search VisaPro website.</li>
		    </ol>';
		    get_search_form();
		echo '</div>';
	}
echo '</section>';
//
