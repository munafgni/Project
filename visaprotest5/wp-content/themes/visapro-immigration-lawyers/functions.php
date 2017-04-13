<?php
/**
 * VisaPro Theme
 *
 * @package      VisaProTheme
 * @since        1.0.0
 * @copyright    Copyright (c) 2017, Visa Pro
 * @license      GPL-2.0+
 */

require get_template_directory() . '/inc/tha-theme-hooks.php';
require get_template_directory() . '/inc/wordpress-cleanup.php';
require get_template_directory() . '/inc/helper-functions.php';
require get_template_directory() . '/inc/archive.php';
require get_template_directory() . '/inc/navigation.php';
require get_template_directory() . '/inc/sidebar-layouts.php';
require get_template_directory() . '/inc/loop.php';
require get_template_directory() . '/inc/tinymce.php';
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/custom-fields-helper.php';
require get_template_directory() . '/inc/wpforms.php';
require get_template_directory() . '/inc/page-extras.php';
require get_template_directory() . '/inc/resources.php';


/**
 * Load Custom Fields
 *
 */
function vp_load_custom_fields() {
	require get_template_directory() . '/inc/custom-fields/front-page.php';
	require get_template_directory() . '/inc/custom-fields/two-column-number-listing.php';
	require get_template_directory() . '/inc/custom-fields/testimonials.php';
	require get_template_directory() . '/inc/custom-fields/about.php';
	require get_template_directory() . '/inc/custom-fields/filing-tips.php';
	require get_template_directory() . '/inc/custom-fields/filing-tip.php';
	require get_template_directory() . '/inc/custom-fields/dictionary.php';
	require get_template_directory() . '/inc/custom-fields/newsletters.php';
	require get_template_directory() . '/inc/custom-fields/newsletter.php';
	require get_template_directory() . '/inc/custom-fields/online-visa-advisor.php';
	require get_template_directory() . '/inc/custom-fields/check-eligibility-response.php';
	require get_template_directory() . '/inc/custom-fields/visa-overview.php';
	require get_template_directory() . '/inc/custom-fields/ebook.php';
	require get_template_directory() . '/inc/custom-fields/thank-you.php';
	require get_template_directory() . '/inc/custom-fields/green-thank-you.php';
	require get_template_directory() . '/inc/custom-fields/faq-listing.php';
	require get_template_directory() . '/inc/custom-fields/faq-answers.php';
	require get_template_directory() . '/inc/custom-fields/immigration-lawyer-consultation.php';
	require get_template_directory() . '/inc/custom-fields/consultation.php';
	require get_template_directory() . '/inc/custom-fields/how-consultation-works.php';
	require get_template_directory() . '/inc/custom-fields/service-options.php';
	require get_template_directory() . '/inc/custom-fields/tabbed-content.php';
	require get_template_directory() . '/inc/custom-fields/content-sidebar.php';
	require get_template_directory() . '/inc/custom-fields/page-options.php';
	require get_template_directory() . '/inc/custom-fields/post-options.php';
	require get_template_directory() . '/inc/custom-fields/theme-options.php';
}
add_action( 'carbon_register_fields', 'vp_load_custom_fields' );

/**
 * Enqueue scripts and styles.
 */
function vp_scripts() {

	$version = !strpos( home_url(), 'visapro.com' ) ? time() : '1.0.0';
//	$version = function_exists( 'vp_is_dev_site' ) && vp_is_dev_site() ? time() : '1.0.0';

	wp_enqueue_script( 'vp-fonts', 'https://use.typekit.net/aov2epx.js', false, 1.0, false );
	wp_add_inline_script( 'vp-fonts', 'try{Typekit.load({ async: true });}catch(e){}' );

	wp_enqueue_style( 'vp-icons', 'https://i.icomoon.io/public/a0959cc52e/VisaPro/style.css' );
	wp_enqueue_style( 'vp-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), $version );
	wp_enqueue_script( 'vp-global', get_stylesheet_directory_uri() . '/assets/js/global-min.js', array( 'jquery' ), $version, true );
	wp_enqueue_script( 'addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4e55f2515aea1803', array(), '1.0', true );


    wp_localize_script( 'vp-global', 'vp_global', array(
        'url' => admin_url( 'admin-ajax.php' ),
    ) );

}
add_action( 'wp_enqueue_scripts', 'vp_scripts' );

/**
 * Template Hierarchy
 *
 */
function vp_template_hierarchy( $template ) {
	if( is_home() || is_category() )
		$template = get_query_template( 'blog' );
	return $template;
}
add_filter( 'template_include', 'vp_template_hierarchy' );


if ( ! function_exists( 'vp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function vp_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ea, use a find and replace
	 * to change 'ea' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'vp', get_template_directory() . '/languages' );

	// Editor Styles
	add_editor_style( 'assets/css/editor-style.css' );

	// Admin Bar Styling
	add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 */
	 $GLOBALS['content_width'] = apply_filters( 'vp_content_width', 640 );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'vp_small', 262, 147, true );
	add_image_size( 'vp_main', 810, 456, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'vp' ),
		'mobile'  => esc_html__( 'Mobile Menu', 'vp' ),
		'select_visa' => esc_html__( 'Select a Visa', 'vp' ),
		'work_visa' => esc_html__( 'Work Visas', 'vp' ),
		'family_visa' => esc_html__( 'Family Visas', 'vp' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif;
add_action( 'after_setup_theme', 'vp_setup' );
