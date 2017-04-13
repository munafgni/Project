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
  * Shortcut function for accessing custom fields
  *
  * @since   1.2.0
  * @param   string $key   custom field key
  * @param   int $id       object ID (post ID, term ID...)
  * @param   array $args   optional arguments
  * @return  mixed
*/
function vp_cf( $key = '', $id = '', $args = array() ) {

    $default_args = array(
        'echo'        => false,
        'prepend'     => false,
        'append'      => false,
        'escape'      => false,
        'type'        => 'post_meta',
        'cf_type'     => false, // use "complex" for complex fields
        'back_compat' => true, // prepend _ on keys if Carbon Fields isn't active
    );
    $args = wp_parse_args( $args, $default_args );
    $value = false;

    // Carbon Fields
    if( function_exists( 'carbon_get_post_meta' ) ) {

        // -- Post Meta
        if( 'post_meta' == $args['type'] ) {
            $id    = ( empty( $id ) ? get_the_ID() : $id );
            $value = carbon_get_post_meta( $id, $key, $args['cf_type'] );

        // -- Theme Option
        } elseif( 'theme_option' == $args['type'] ) {
            $value = carbon_get_theme_option( $key, $args['cf_type'] );

        // -- Term Meta
        } elseif( 'term_meta' == $args['type'] ) {
            $id = ( empty( $id ) ? get_queried_object_id() : $id );
            $value = carbon_get_term_meta( $id, $key, $args['cf_type'] );

        // -- User Meta
        } elseif( 'user_meta' == $args['type'] ) {
            $id = ( empty( $id ) ? get_queried_object_id() : $id );
            $value = carbon_get_user_meta( $id, $key, $args['cf_type'] );

        // -- Comment Meta
        } elseif( 'comment_meta' == $args['type'] ) {
            $id = ( empty( $id ) ? get_queried_object_id() : $id );
            $value = carbon_get_comment_meta( $id, $key, $args['cf_type'] );

        }

    // Fallback to standard post meta (doesn't work with other types of metadata)
    } elseif( 'post_meta' == $args['type'] ) {
        $id    = ( empty( $id ) ? get_the_ID() : $id );
        $key   = $args['back_compat'] ? '_' . $key : $key;
        $value = get_post_meta( $id, $key, true );
    }

    // Additional formatting before output
    // Only run on simple fields (not complex ones)
    if( ! $args['cf_type'] ) {

        if( $args['escape'] ) {
            $value = call_user_func( $args['escape'], $value );
        }

        if( $value && $args['prepend'] ) {
            $value = $args['prepend'] . $value;
        }
        if( $value && $args['append'] ) {
            $value .= $args['append'];
        }
    }

    // Echo vs Return
    if ( $args['echo'] ) {
        echo $value;

    } else {
        return $value;
    }
}

/**
 * Remove Editor
 *
 */
function vp_remove_editor() {

    $screen = get_current_screen();
    if( 'page' !== $screen->id || ! isset( $_GET['post']) )
        return;
    $post_id = intval( $_GET['post'] );

    $templates = array(
        'templates/testimonials.php',
        'templates/filing-tips.php',
        'templates/filing-tip.php',
        'templates/dictionary.php',
        'templates/tabbed-content.php',
        'templates/work-visa-temporary-options.php',
        'templates/work-visa-permanent-options.php',
        'templates/visa-eligibility-questionnaire.php',
        'templates/resources.php',
        'templates/faq-listing.php',
        'templates/faq-answers.php',
        'templates/immigration-lawyer-consultation.php',
        'templates/how-consultation-works.php',
        'templates/front-page.php',
    );

    $ids = array( get_option( 'page_on_front' ) );

    if( in_array( $post_id, $ids ) || in_array( get_page_template_slug( $post_id ), $templates ) ) {
        remove_post_type_support( 'page', 'editor' );
    }

}
add_action( 'admin_head', 'vp_remove_editor' );
