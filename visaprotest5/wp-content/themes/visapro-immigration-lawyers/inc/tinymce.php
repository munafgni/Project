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
  * Add "Styles" drop-down to TinyMCE
  *
  * @since 1.0.0
  * @param array $buttons
  * @return array
  */
 function vp_mce_editor_buttons( $buttons ) {
 	array_unshift( $buttons, 'styleselect' );
    $buttons[] = 'underline';
 	return $buttons;
 }
 add_filter( 'mce_buttons_2', 'vp_mce_editor_buttons' );

 /**
  * Add styles/classes to the TinyMCE "Formats" drop-down
  *
  * @since 1.0.0
  * @param array $settings
  * @return array
  */
 function vp_mce_before_init( $settings ) {

 	$style_formats = array(
        array(
            'title'    => 'Image, No Border',
            'selector' => 'img',
            'classes'  => 'no-border',
        ),
        array(
            'title'    => 'Yellow Blockquote',
            'selector' => 'blockquote',
            'classses' => 'yellow',
        ),
        array(
            'title'    => 'Small Text',
            'selector' => 'p',
            'classes'  => 'small',
        ),
        array(
            'title'    => 'Disclaimer Text',
            'selector' => 'p',
            'classes'  => 'disclaimer',
        ),
 		array(
 			'title'    => 'Button',
 			'selector' => 'a',
 			'classes'  => 'button',
 		),
        array(
            'title'    => 'Outline Button',
            'selector' => 'a',
            'classes'  => 'button button-outline',
        ),
        array(
            'title'    => 'Orange Button',
            'selector' => 'a',
            'classes'  => 'button button-orange',
        ),
        array(
            'title'    => 'Block Button',
            'selector' => 'a',
            'classes'  => 'button button-block',
        ),
        array(
            'title'    => 'Phone Button',
            'selector' => 'a',
            'classes'  => 'button button-phone',
        ),
        array(
            'title'    => 'Large Numbers',
            'selector' => 'ol',
            'classes'  => 'large-numbers',
        ),
        array(
            'title'    => 'Downloads',
            'selector' => 'ul',
            'classes'  => 'downloads',
        )
 	);
 	$settings['style_formats'] = json_encode( $style_formats );
 	return $settings;
 }
 add_filter( 'tiny_mce_before_init', 'vp_mce_before_init' );
