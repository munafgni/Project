<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

// Duplicate 'the_content' filters
global $wp_embed;
add_filter( 'vp_the_content', array( $wp_embed, 'run_shortcode' ), 8 );
add_filter( 'vp_the_content', array( $wp_embed, 'autoembed'     ), 8 );
add_filter( 'vp_the_content', 'wptexturize'        );
add_filter( 'vp_the_content', 'convert_chars'      );
add_filter( 'vp_the_content', 'wpautop'            );
add_filter( 'vp_the_content', 'shortcode_unautop'  );
add_filter( 'vp_the_content', 'do_shortcode'       );

/**
 * Get the first term attached to post
 *
 * @param string $taxonomy
 * @param string/int $field, pass false to return object
 * @param int $post_id
 * @return string/object
 */
function vp_first_term( $taxonomy = 'category', $field = 'name', $post_id = false ) {

	$post_id = $post_id ? $post_id : get_the_ID();
	$term = false;

	// Use WP SEO Primary Term
	// from https://github.com/Yoast/wordpress-seo/issues/4038
	if( class_exists( 'WPSEO_Primary_Term' ) ) {
		$term = get_term( ( new WPSEO_Primary_Term( $taxonomy,  $post_id ) )->get_primary_term(), $taxonomy );
	}

	// Fallback on term with highest post count
	if( ! $term || is_wp_error( $term ) ) {

		$terms = get_the_terms( $post_id, $taxonomy );

		if( empty( $terms ) || is_wp_error( $terms ) )
			return false;

		// If there's only one term, use that
		if( 1 == count( $terms ) ) {
			$term = array_shift( $terms );

		// If there's more than one...
		} else {

			// Sort by term order if available
			// @uses WP Term Order plugin
			if( isset( $terms[0]->order ) ) {
				$list = array();
				foreach( $terms as $term )
					$list[$term->order] = $term;
				ksort( $list, SORT_NUMERIC );

			// Or sort by post count
			} else {
				$list = array();
				foreach( $terms as $term )
					$list[$term->count] = $term;
				ksort( $list, SORT_NUMERIC );
				$list = array_reverse( $list );
			}

			$term = array_shift( $list );
		}
	}

	// Output
	if( $field && isset( $term->$field ) )
		return $term->$field;

	else
		return $term;
}

/**
 * Conditional CSS Classes
 *
 * @param string $base_classes, classes always applied
 * @param string $optional_class, additional class applied if $conditional is true
 * @param bool $conditional, whether to add $optional_class or not
 * @return string $classes
 */
function vp_class( $base_classes, $optional_class, $conditional ) {
	return $conditional ? $base_classes . ' ' . $optional_class : $base_classes;
}

/**
 * Column Classes
 *
 * @param int $type, number from 2-6
 * @param int $count, current count in the loop
 * @param int $tablet_type, number of columns used on tablets
 * @return string $classes
 */
function vp_column_class( $type, $count, $tablet_type = false ) {
	$output = '';
	$classes = array( '', '', 'one-half', 'one-third', 'one-fourth', 'one-fifth', 'one-sixth' );
	if( !empty( $classes[$type] ) )
		$output = vp_class( $classes[$type], 'first', 0 == $count % $type );

	if( $tablet_type && !empty( $classes[$tablet_type] ) )
		$output .= ' ' . vp_class( 'tablet-' . $classes[$tablet_type], 'tablet-first', 0 == $count % $tablet_type );

	return $output;
}

/**
 * Default Widget Area Arguments
 *
 * @param array $args
 * @return array $args
 */
function vp_widget_area_args( $args = array() ) {

   $defaults = array(
	   'name'          => '',
	   'id'            => '',
	   'description'   => '',
	   'before_widget' => '<section id="%1$s" class="widget %2$s">',
	   'after_widget'  => '</section>',
	   'before_title'  => '<h6 class="widget-title">',
	   'after_title'   => '</h6>',
   );
   $args = wp_parse_args( $args, $defaults );

   if( !empty( $args['name'] ) && empty( $args['id'] ) )
	   $args['id'] = sanitize_title_with_dashes( $args['name'] );

   return $args;

}

/**
 * Post Image
 *
 */
function vp_post_image_id( $post_id = false, $fallback_id = false ) {
	$post_id = $post_id ? intval( $post_id ) : get_the_ID();
	$fallback_id = $fallback_id ? intval( $fallback_id ) : vp_cf( 'vp_default_post_image', false, array( 'type' => 'theme_option' ) );

	if( has_post_thumbnail( $post_id ) )
		$image_id = get_post_thumbnail_id( $post_id );
	else
		$image_id = $fallback_id;

	return $image_id;
}

/**
 * Stars
 *
 */
function vp_stars( $count = 5 ) {
	$output = '';
	for( $i = 0; $i < $count; $i++ ) {
		$output .= '<i class="icon-star"></i>';
	}
	return '<span class="stars">' . $output . '</span>';
}

/**
 * Phone URL
 * @author Bill Erickson
 * @link http://www.billerickson.net/phone-number-url
 *
 * @param string $phone_number, ex: (555) 123-4568
 * @return string $phone_url, ex: tel:5551234568
 */
function vp_phone_url( $phone_number = false ) {
	$phone_number = str_replace( array( '(', ')', '-', '.', '|', ' ' ), '', $phone_number );
	return esc_url( 'tel:' . $phone_number );
}

/**
 * Tip Title
 *
 */
function vp_tip_title( $tip_id = false, $parent_id = false) {
	$tip_id = $tip_id ? intval( $tip_id ) : get_the_ID();
	$parent_id = $parent_id ? intval( $parent_id ) : get_post( $tip_id )->post_parent;
	return str_replace( 'Filing Tips', get_the_title( $tip_id ), vp_cf( 'vp_page_title', $parent_id ) );
}

/**
 * Consultation Timeline
 *
 */
function vp_consultation_timeline() {
	$output = '<ol class="consultation-timeline">';
	$output .= '<li>Sign Up</li>';
	$output .= '<li>Ask Questions</li>';
	$output .= '<li>Make Payment</li>';
	$output .= '<li>Get Advice</li>';
	$output .= '</ol>';
	return $output;
}

/**
 * Resource Page IDs
 * Used for querying resources
 */
function vp_resource_page_ids() {
	return array( 358, 360, 362, 364, 366 );
}

/**
 * Select Menu
 *
 */
function vp_select_menu( $theme_location = false, $placeholder = false ) {

	if( ! $theme_location )
		return;

	$theme_locations = get_nav_menu_locations();
	if( ! isset( $theme_locations[$theme_location] ) )
		return;

	$menu_items = wp_get_nav_menu_items( $theme_locations[$theme_location] );
	if( empty( $menu_items ) )
		return;

	$output = '<form><select class="' . str_replace( '_' , '-', $theme_location ) . '" onchange="if (this.value) window.location.href=this.value">';
	if( !empty( $placeholder ) )
		$output .= '<option value="" disabled selected>' . esc_html( $placeholder ) . '</option>';

	foreach( $menu_items as $menu_item )
		$output .= '<option value="' . $menu_item->url . '">' . $menu_item->title . '</option>';

	$output .= '</select></form>';
	return $output;
}
