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
 * Free Assessment Footer
 *
 */
function vp_form_free_assessment_footer( $form_data, $form, $title, $description, $errors ) {

    if( ! in_array( $form->ID, array( 144, 349, 354, 380, 387, 475 ) ) )
        return;

    echo '<p class="small-footer">Act Now - free spots fill up fast!</p>';
}
add_action( 'wpforms_frontend_output', 'vp_form_free_assessment_footer', 26, 5 );

/**
 * Login Form Action
 *
 */
function vp_form_login_action( $action, $form_data, $form ) {
    if( 286 == $form->ID )
        $action = home_url( 'form-test' );
        //$action = 'http://www.visapro.com/s/processlogin.asp';
    return $action;
}
add_filter( 'wpforms_frontend_form_action', 'vp_form_login_action', 10, 3 );

/**
 * Login Error
 *
 */
function vp_form_login_error( $form_data, $form, $title, $description, $errors ) {
    if( isset( $_GET['vp_error'] ) && true === filter_var( $_GET['vp_error'], FILTER_VALIDATE_BOOLEAN ) )
        echo '<p class="disclaimer red" style="margin: 10px 0 0;">Invalid username/password</p>';
}
add_action( 'wpforms_frontend_output', 'vp_form_login_error', 9, 5 );

/**
 * Login Footer
 *
 */
function vp_form_login_footer( $form_data, $form, $title, $description, $errors ) {
    if( 286 !== $form->ID )
        return;

    echo '<p class="small-footer"><strong>Need an account? <a class="orange" href="' . home_url( 'signup' ) . '">Sign up now</a></strong><br /><a href="#">Having trouble logging in?</a></p>';
}
add_action( 'wpforms_frontend_output', 'vp_form_login_footer', 26, 5 );

/**
 * Dynamic Countries
 *
 */
function vp_wpforms_country_dropdown( $field, $field_atts, $form_data ) {
    if( ! in_array( 'dynamic-countries', $field_atts['field_class'] ) )
        return $field;
    $field['choices'] = array();
    $states = wpforms_countries();
    foreach( $states as $value => $label )
        $field['choices'][] = array( 'label' => $label, 'value' => $value );
    return $field;
}
add_filter( 'wpforms_select_field_display', 'vp_wpforms_country_dropdown', 10, 3 );

/**
 * Newsletter Subscribe
 *
 */
function vp_newsletter_subscribe( $fields, $entry, $form_data, $form_id ) {

    $api_url = 'https://api.getresponse.com/v3/contacts';
    $args = array(
        'headers' => array(
            'Content-type' => 'application/json',
            'X-Auth-Token' => 'api-key b5d1bf5b3144deba96e9ca0986ad51a3'
        )
    );

    $response = wp_remote_get( $api_url, $args );
    ea_pp( $response );
}
//add_action( 'wpforms_process_complete_304', 'vp_newsletter_subscribe', 10, 4 );


/**
 * Submit Signup Information
 *
 */
 function vp_form_signup_submit( $fields, $entry, $form_data, $form_id ) {

    $api_url = 'http://www.visapro.com/process.asp';
 	$body = array(
 		'secret'              => 'MZMGjhxxPGsgY6GFB',
 		'name'                => $fields['1']['value'],
 		'company_name'        => $fields['2']['value'],
 		'email'               => $fields['3']['value'],
 		'phone'               => $fields['4']['value'],
 		'username'            => $fields['5']['value'],
 		'password'            => $fields['6']['value'],
 		'agree'               => $fields['8']['value'],
        'submitted'           => time(),
 	);

 	$request = wp_remote_post( $api_url, array( 'body' => $body ) );

 	// Simple error handling
 	if ( is_wp_error( $request ) ) {

 		$msg  = "There was an error trying to sign up a new user.\n";
 		$msg .= 'Error returned: ' . $error = $request->get_error_message() . "\n\n";
 		$msg .= "The lead below may need to be added to the CRM manually.\n";
 		$msg .= $body['name'] . ' ' . $body['email'];

 		wp_mail( get_bloginfo( 'admin_email' ), 'CRM Connector Error', $msg );
 	}
 }
 add_action( 'wpforms_process_complete_290', 'vp_form_signup_submit', 10, 4 );

/**
 * Ebook URL Smart Tag
 *
 */
function vp_form_ebook_url_smart_tag( $content, $form_data, $fields = '', $entry_id = '' ) {

    // Basic smart tags
    preg_match_all( "/\{(.+?)\}/", $content, $tags );
    if ( !empty( $tags[1] ) ) {
        foreach( $tags[1] as $key => $tag ) {
            if( 'redirect_uri' == $tag ) {

                $url = $post_id = $name = false;

                foreach( $fields as $i => $field ) {
                    if( !empty( $fields[$i]['css_class'] ) ) {
                        $classes = explode( ' ', $fields[$i]['css_class'] );
                        if( in_array( 'page-id', $classes ) ) {
                            $post_id = $fields[$i]['value'];
                        } elseif( in_array( 'name',  $classes ) ) {
                            $name = $fields[$i]['value'];
                        }
                    }
                }

                if( !empty( $post_id ) ) {
                    $url = vp_cf( 'vp_ebook_thank_you_url', $post_id );
                    if( !empty( $name ) )
                        $url .= '?vp_name=' . esc_html( $name );
                }

                $content = str_replace( '{' . $tag . '}', $url, $content );
            }
        }
    }

    return $content;
}
//add_filter( 'wpforms_process_smart_tags', 'vp_form_ebook_url_smart_tag', 20, 4 );

/**
 * Page specific form redirect
 *
 */
function vp_page_specific_form_redirect( $url, $form_id, $fields ) {

    $custom_url = $post_id = $name = false;

    foreach( $fields as $i => $field ) {

        if( 'name' == $field['type'] )
            $name = $fields[$i]['value'];
        if( 'Page ID' == $field['name'] )
            $post_id = $fields[$i]['value'];
    }

    if( !empty( $post_id ) ) {
        $custom_url = vp_cf( 'vp_ebook_thank_you_url', $post_id ) . '?vp_name=' . $fields[1]['value'] . '&vp_email=' . $fields[2]['value'];
    }

    if( !empty( $custom_url ) )
        return $custom_url;
    else
        return $url;

}
add_filter( 'wpforms_process_redirect_url', 'vp_page_specific_form_redirect', 10, 3 );
