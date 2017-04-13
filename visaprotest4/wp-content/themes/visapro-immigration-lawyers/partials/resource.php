<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

echo '<article class="resource-item type-' . get_post_field( 'post_name', wp_get_post_parent_id( get_the_ID() ) ) . '">';
echo '<a href="' . get_permalink() . '" class="entry-image-link">' . wp_get_attachment_image( vp_post_image_id(), 'vp_small' ) . '</a>';
echo '<a href="' . get_permalink() . '" class="entry-title">' . get_the_title() . '</a>';
echo '</article>';
