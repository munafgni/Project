<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

echo '<article class="' . join( ' ', get_post_class() ) . '">';

    echo '<a class="entry-image-link" href="' . get_permalink() . '">' . wp_get_attachment_image( vp_post_image_id(), 'vp_small' ) . '</a>';

	echo '<header class="entry-header">';
	   echo '<h2 class="entry-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
       echo '<p class="article-url"><a href="' . get_permalink() . '">' . get_permalink() . '</a></p>';
	echo '</header>';

	echo '<div class="entry-content">';
		tha_entry_content_before();
		the_excerpt();
		tha_entry_content_after();
	echo '</div>';

	echo '<footer class="entry-footer">';
		tha_entry_bottom();
	echo '</footer>';

echo '</article>';
