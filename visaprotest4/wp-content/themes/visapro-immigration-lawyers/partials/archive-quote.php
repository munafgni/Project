<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

$classes = get_post_class();
$classes[] = 'format-quote';

echo '<article class="' . join( ' ', $classes ) . '">';
	vp_entry_date();
	echo '<blockquote class="red">';
	echo '<h2 class="entry-title">' . get_the_title() . '</h2>';
	echo vp_cf( 'vp_quote_byline', false, array( 'escape' => 'esc_html', 'prepend' => '<p>', 'append' => '</p>' ) );
	echo '</blockquote>';
echo '</article>';
