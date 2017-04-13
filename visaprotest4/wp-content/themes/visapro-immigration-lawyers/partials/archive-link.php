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
$classes[] = 'format-link';

echo '<article class="' . join( ' ', $classes ) . '">';
	vp_entry_date();
	echo '<blockquote class="red">';
	echo '<h2 class="entry-title">' . get_the_title() . '</h2>';
	$url = esc_url( get_post_meta( get_the_ID(), '_links_to', true ) );
	echo '<p>' . $url . '</p>';
	echo '<a class="block-link" href="' . $url . '"></a>';
	echo '</blockquote>';
echo '</article>';
