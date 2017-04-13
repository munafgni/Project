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
 * Testimonial
 *
 */
function vp_testimonial_shortcode( $atts = array() ) {

    $atts = shortcode_atts( array(
        'id'             => 'any',
        'include_button' => true,
        'include_title'  => true,
    ), $atts, 'testimonial' );

    if( 'any' !== $atts['id'] )
        $atts['id'] = absint( $atts['id'] );

    $atts['include_button'] = filter_var( $atts['include_button'], FILTER_VALIDATE_BOOLEAN );
    $atts['include_title']  = filter_var( $atts['include_title'], FILTER_VALIDATE_BOOLEAN );

    $testimonials = vp_cf( 'vp_testimonials', false, array( 'type' => 'theme_option', 'cf_type' => 'complex' ) );
    if( empty( $testimonials ) )
        return;

    if( isset( $testimonials[$atts['id']] ) ) {
        $testimonial = $testimonials[$atts['id']];
    } else {
        $testimonial = $testimonials[array_rand( $testimonials )];
    }

    $output = '<div class="inpost-testimonial">';
    if( $atts['include_title'] )
        $output .= '<h4>What VisaPro Customers Are Saying</h4>';
    $output .= '<p>' . vp_stars() . esc_html( $testimonial['quote'] ) . '</p>';
    $avatar = !empty( $testimonial['image'] ) ? wp_get_attachment_image( intval( $testimonial['image'] ), 'thumbnail', null, array( 'class' => 'avatar no-border' ) ) : '';
    if( !empty( $testimonial['byline'] ) )
        $output .= '<p class="byline">' . $avatar . esc_html( $testimonial['byline'] ) . '</p>';
    if( $atts['include_button'] )
        $output .= '<p><a href="' . home_url( 'service-options/visa-assessment' ) . '" class="button button-outline">Get a Free Visa Estimate</a></p>';
    $output .= '</div>';
    return $output;
}
add_shortcode( 'testimonial', 'vp_testimonial_shortcode' );

/**
 * Testimonial Shortcode UI
 *
 */
function vp_testimonial_shortcode_ui() {

    if( ! function_exists( 'shortcode_ui_register_for_shortcode' ) )
		return;

    $testimonials = vp_cf( 'vp_testimonials', false, array( 'type' => 'theme_option', 'cf_type' => 'complex' ) );
    if( empty( $testimonials ) )
        return;

    $options = array();
    $options[] = array( 'value' => 'any', 'label' => 'Any Testimonial' );
    foreach( $testimonials as $i => $testimonial ) {
        $options[] = array( 'value' => $i, 'label' => $testimonial['byline'] );
    }

	shortcode_ui_register_for_shortcode( 'testimonial', array(
		'label'         => 'Testimonial',
		'listItemImage' => 'dashicons-format-quote',
		'attrs'         => array(
			array(
				'label'    => 'Select Testimonial',
				'attr'     => 'id',
				'type'     => 'select',
                'options'  => $options,
			),
            array(
                'label'    => 'Include Title',
                'attr'     => 'include_title',
                'type'     => 'select',
                'options'  => vp_select_true_false_options(),
            ),
            array(
                'label'    => 'Include Button',
                'attr'     => 'include_button',
                'type'     => 'select',
                'options'  => vp_select_true_false_options(),
            )
		)
	) );
}
add_action( 'init', 'vp_testimonial_shortcode_ui' );

/**
 * Testimonial Options for Metabo
 *
 */
function vp_testimonial_options_for_metabox() {
    $testimonials = vp_cf( 'vp_testimonials', false, array( 'type' => 'theme_option', 'cf_type' => 'complex' ) );
    if( empty( $testimonials ) )
        return;

    $options = array();
    $options['Any'] = 'Any Testimonial';
    foreach( $testimonials as $i => $testimonial ) {
        $options[$i] = $testimonial['byline'];
    }

    return $options;
}

/**
 * Select True/False Options
 *
 */
function vp_select_true_false_options() {
    return array( array( 'value' => 'true', 'label' => 'Yes' ), array( 'value' => 'false', 'label' => 'No' ) );
}

/**
 * Trust Icons Shortcode
 *
 */
function vp_trust_icons_shortcode( $attr = array() ) {
    $attr = shortcode_atts( array(
        'align' => 'left',
    ), $attr );
    $align = esc_attr( 'align' . $attr['align'] );
    return '<img src="' . get_template_directory_uri() . '/assets/images/trust-symbols.png" class="trust ' . $align . ' no-border" />';
}
add_shortcode( 'trust_icons', 'vp_trust_icons_shortcode' );

/**
 * Trust Icons Shortcode UI
 *
 */
function vp_trust_icons_shortcode_ui() {

    if( ! function_exists( 'shortcode_ui_register_for_shortcode' ) )
		return;

	shortcode_ui_register_for_shortcode( 'trust_icons', array(
		'label'         => 'Trust Icons',
		'listItemImage' => 'dashicons-thumbs-up',
        'attrs'         => array(
            array(
                'label'   => 'Alignment',
                'attr'    => 'align',
                'type'    => 'select',
                'options' => array(
                    array(
                        'value' => 'left',
                        'label' => 'Left',
                    ),
                    array(
                        'value' => 'center',
                        'label' => 'Center',
                    ),
                    array(
                        'value' => 'right',
                        'label' => 'Right',
                    )
                )
            )
        )
	) );

}
add_action( 'init', 'vp_trust_icons_shortcode_ui' );

/**
 * CTA Shortcode
 *
 */
function vp_cta_shortcode( $atts = array() ) {

    $atts = shortcode_atts( array(
        'type' => 'get_started',
    ), $atts, 'cta' );

    $ctas = wp_list_pluck( vp_available_ctas(), 'value' );
    $cta = in_array( $atts['type'], $ctas ) ? $atts['type'] : array_shift( $ctas );
    $output = '';

    switch( $cta ) {

        case 'get_started':
        case 'immigration_issues':
        case 'talk_now':
            $title = vp_cf( 'vp_cta_' . $cta . '_title', false, array( 'type' => 'theme_option', 'escape' => 'esc_html', 'prepend' => '<h4>', 'append' => '</h4>' ) );
            $content = apply_filters( 'vp_the_content', vp_cf( 'vp_cta_' . $cta . '_content', false, array( 'type' => 'theme_option' ) ) );
            $button_text = vp_cf( 'vp_cta_' . $cta . '_button_text', false, array( 'type' => 'theme_option' ) );
            $button_url = vp_cf( 'vp_cta_' . $cta . '_button_url', false, array( 'type' => 'theme_option' ) );
            $button = $button_text && $button_url ? '<a class="button button-orange" href="' . esc_url( $button_url ) . '">' . esc_html( $button_text ) . '</a>' : '';
            $class = 'inpost-cta type-' . str_replace( '_', '-', $cta );
            $output = '<div class="' . $class . '">' . $title . $content . $button . '</div>';
            break;

        case 'free_assessment_form':
            ob_start();
            wpforms_display( 144, true, true );
            $form = ob_get_clean();
            $output = '<div class="inpost-cta type-free-assessment-form">' . $form . '</div>';
            break;

        case 'check_eligibility':
            $output = '<div class="inpost-cta type-check-eligibility">';
            $output .= '<div class="check-eligibility">';
            $output .= vp_select_menu( 'work_visa', 'Select a Work Visa' );
            $output .= '<span class="or">OR</span>';
            $output .= vp_select_menu( 'family_visa', 'Select a Family Visa' );
            $output .= '<a href="' . home_url( 'online-visa-advisor/visa-eligibility' ) . '" class="button">Check My Eligibility</a>';
            $output .= '</div></div>';
            break;
    }

    return $output;

}
add_shortcode( 'cta', 'vp_cta_shortcode' );

/**
 * CTA Shortcode UI
 *
 */
function vp_cta_shortcode_ui() {

    if( ! function_exists( 'shortcode_ui_register_for_shortcode' ) )
		return;

	shortcode_ui_register_for_shortcode( 'cta', array(
		'label'         => 'CTA',
		'listItemImage' => 'dashicons-upload',
		'attrs'         => array(
			array(
				'label'    => 'Select CTA',
				'attr'     => 'type',
				'type'     => 'select',
                'options'  => vp_available_ctas(),
			)
		)
	) );
}
add_action( 'init', 'vp_cta_shortcode_ui' );

/**
 * Available CTAs
 *
 */
function vp_available_ctas() {
    return array(
        array(
            'value' => 'get_started',
            'label' => 'Get Started'
        ),
        array(
            'value' => 'talk_now',
            'label' => 'Talk Now',
        ),
        array(
            'value' => 'immigration_issues',
            'label' => 'Immigration Issues',
        ),
        array(
            'value' => 'free_assessment_form',
            'label' => 'Free Assessment Form',
        ),
        array(
            'value' => 'check_eligibility',
            'label' => 'Check Eligibility',
        )
    );
}

/**
 * Social Links
 *
 */
function vp_social_links_shortcode( $atts = array() ) {

    $atts = shortcode_atts( array(
        'socials' => 'facebook youtube twitter googleplus linkedin feed pinterest',
        'style'   => 'link',
    ), $atts );

    $socials = explode( ' ', $atts['socials'] );
    $style = in_array( $atts['style'], array( 'link', 'box' ) ) ? $atts['style'] : 'link';
    $social_output = array();
    foreach( $socials as $social ) {
        $url = vp_cf( 'vp_' . $social, false, array( 'type' => 'theme_option' ) );
        if( !empty( $url ) )
            $social_output[] = '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $social ) . '"><i class="icon-' . esc_attr( $social ) . '"></i></a>';
    }

    if( !empty( $social_output ) )
        return '<p class="socials style-' . $style . '">' . join( ' ', $social_output ) . '</p>';
}
add_shortcode( 'social_links', 'vp_social_links_shortcode' );

/**
 * Footer Email Newsletter
 *
 */
function vp_footer_email_newsletter_shortcode() {
    return '<form class="footer-email-newsletter"><input type="email" placeholder="Enter your email address" /><button type="submit" class="button">Go</button></form>';
}
add_shortcode( 'footer_email_newsletter', 'vp_footer_email_newsletter_shortcode' );

/**
 * Social Sharing
 *
 */
function vp_social_sharing() {
    return '<div class="social-sharing"><div class="addthis_inline_share_toolbox"></div></div>';
}
add_shortcode( 'social_sharing', 'vp_social_sharing' );

/**
 * Social Sharing UI
 *
 */
function vp_social_sharing_ui() {

    if( ! function_exists( 'shortcode_ui_register_for_shortcode' ) )
		return;

	shortcode_ui_register_for_shortcode( 'social_sharing', array(
		'label'         => 'Social Sharing',
		'listItemImage' => 'dashicons-twitter',
	) );
}
add_action( 'init', 'vp_social_sharing_ui' );

/**
 * Disqus Comments
 *
 */
function vp_disqus_comments() {
    return '<a href="#" class="button button-block show-comments">Click here to add a comment</a><div id="disqus_thread"></div>';
}
add_shortcode( 'disqus_comments', 'vp_disqus_comments' );

/**
 * Disqus Comments UI
 *
 */
function vp_disqus_comments_ui() {

    if( ! function_exists( 'shortcode_ui_register_for_shortcode' ) )
		return;

	shortcode_ui_register_for_shortcode( 'disqus_comments', array(
		'label'         => 'Disqus Comments',
		'listItemImage' => 'dashicons-admin-comments',
	) );

}
add_action( 'init', 'vp_disqus_comments_ui' );

/**
 * Search Form
 *
 */
function vp_search_form_shortcode() {
    return get_search_form( false );
}
add_shortcode( 'search_form', 'vp_search_form_shortcode' );

/**
 * Name
 *
 */
function vp_name_shortcode() {
    $name = false;
    if( isset( $_GET['vp_name'] ) )
        $name = esc_html( $_GET['vp_name'] );

    if( !empty( $name ) )
        return '<span class="orange">' . $name . '</span>';
}
add_shortcode( 'name', 'vp_name_shortcode' );
