<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

 /* Template Name: Form Test */

/**
 * Form Test
 */
function vp_form_test() {
    if( isset( $_POST['wpforms'] ) ) {

        foreach( $_POST['wpforms']['complete'] as $field ) {
            echo '<p><strong>' . esc_html( $field['name'] ) . '</strong>: ' . esc_html( $field['value'] ) . '</p>';
        }
    }
}
add_action( 'tha_entry_content_before', 'vp_form_test' );

// Build the page
require get_template_directory() . '/index.php';
