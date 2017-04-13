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
 * Above Header
 *
 */
function vp_above_header() {
    echo '<div class="above-header"><div class="wrap">';
        $phone = vp_cf( 'vp_phone', false, array( 'type' => 'theme_option' ) );
        if( $phone )
            echo '<div class="call-us">Call Us Today: <a href="' . vp_phone_url( $phone ) . '">' . $phone . '</a></div>';
        echo '<div class="right">';
            echo '<div class="header-search">' . get_search_form( false ) . '</div>';
            echo '<div class="select-visa">';
                echo '<a href="#">Select a Visa</a>';
                wp_nav_menu( array( 'theme_location' => 'select_visa', 'container_class' => 'dropdown' ) );
            echo '</div>';
            echo '<div class="language">' . vp_translate_page() . '</div>';
            echo '<div class="more"><a href="' . home_url( 'service-options/visa-assessment' ) . '">Free Assessment</a> | <a href="' . esc_url( vp_cf( 'vp_login', false, array( 'type' => 'theme_option' ) ) ) . '">Login</a></div>';
        echo '</div>';
        echo '<div class="site-information"><i class="icon-info"></i> www.visapro.com</div>';
    echo '</div></div>';
}
add_action( 'tha_header_before', 'vp_above_header' );

/**
 * Header Navigation
 *
 */
function vp_header_navigation() {

  if( has_nav_menu( 'primary' ) ) {
    echo '<nav class="nav-primary nav-menu" role="navigation">';
    wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) );
    echo '</nav>';
  }

  if( has_nav_menu( 'mobile' ) ) {
    echo '<div class="nav-mobile">';
        echo '<a href="' . home_url( 'contact-us' ) . '"><i class="icon-email"></i></a>';
        $phone = vp_cf( 'vp_phone', false, array( 'type' => 'theme_option' ) );
        if( $phone )
            echo '<a href="' . vp_phone_url( $phone ) . '"><i class="icon-phone"></i></a>';
        echo '<a class="mobile-search-toggle" href="#"><i class="icon-search"></i></a>';
        echo '<a class="mobile-menu-toggle" href="#"><i class="icon-menu"></i></a>';
    echo '</div>';
  }
}
add_action( 'tha_header_bottom', 'vp_header_navigation' );

/**
 * Limit Header Menu Depth
 *
 */
function vp_primary_menu_depth( $args ) {

	if( 'primary' == $args['theme_location'] )
		$args['depth'] = 1;

	return $args;
}
add_filter( 'wp_nav_menu_args', 'vp_primary_menu_depth' );

/**
 * Register Mega Menu post type
 *
 */
function vp_mega_menu_cpt() {

	$labels = array(
		'name'               => 'Mega Menus',
		'singular_name'      => 'Mega Menu',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Mega Menu',
		'edit_item'          => 'Edit Mega Menu',
		'new_item'           => 'New Mega Menu',
		'view_item'          => 'View Mega Menu',
		'search_items'       => 'Search Mega Menus',
		'not_found'          => 'No Mega Menus found',
		'not_found_in_trash' => 'No Mega Menus found in Trash',
		'parent_item_colon'  => 'Parent Mega Menu:',
		'menu_name'          => 'Mega Menus',
	);

	$args = array(
		'labels'              => $labels,
		'hierarchical'        => false,
		'supports'            => array( 'title', 'editor', 'revisions' ),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => 'themes.php',
		'show_in_nav_menus'   => false,
		'publicly_queryable'  => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'query_var'           => true,
		'can_export'          => true,
		'rewrite'             => array( 'slug' => 'megamenu', 'with_front' => false ),
		'menu_icon'           => 'dashicons-editor-table', // https://developer.wordpress.org/resource/dashicons/
	);

	register_post_type( 'megamenu', $args );

}
add_action( 'init', 'vp_mega_menu_cpt' );

/**
 * Display Mega Menus
 *
 */
function vp_mega_menu_display( $item_output, $item, $depth, $args ) {

	if( ! ( 'primary' == $args->theme_location && 0 == $depth ) )
		return $item_output;

	$submenu_object = false;
	foreach( $item->classes as $class ) {
		if( strpos( $class, 'megamenu-' ) !== false )
			$submenu_object = get_post( str_replace( 'megamenu-', '', $class ) );
	}
	if( ! $submenu_object )
		$submenu_object = get_page_by_title( $item->title, false, 'megamenu' );

	// WPML Support
	if( function_exists( 'icl_object_id' ) && $submenu_object ) {
		$translation = icl_object_id( $submenu_object->ID, 'megamenu', false );
		if( $translation ) {
			$submenu_object = get_post( $translation );
		}
	}

	if( !empty( $submenu_object ) && ! is_wp_error( $submenu_object ) ) {

		$opening_markup = '<div class="mega-menu"><div class="wrap">';
		$closing_markup = '</div></div>';
		$submenu = $opening_markup . apply_filters( 'vp_the_content', $submenu_object->post_content ) . $closing_markup;

		$item_output = str_replace( '</a>', '<span class="submenu-toggle"></span></a>' . $submenu, $item_output );

	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'vp_mega_menu_display', 10, 4 );

/**
 * Mobile Menu
 *
 */
function vp_mobile_menu() {
  if( has_nav_menu( 'mobile' ) ) {

    echo '<div id="sidr-mobile-menu" class="sidr right">';
      echo '<div class="mobile-menu-header">';
        echo '<a class="login" href="' . esc_url( vp_cf( 'vp_login', false, array( 'type' => 'theme_option' ) ) ) . '">Login / Sign Up</a>';
        echo '<a class="close" href="#"><i class="icon-close"></i> Close</a>';
      echo '</div>';

      wp_nav_menu( array( 'theme_location' => 'mobile' ) );

      echo '<div class="mobile-menu-footer"><a href="' . home_url( 'service-options/visa-assessment' ) . '" class="button button-orange button-block">Free Visa Assessment</a></div>';

    echo '</div></div>';
  }
}
add_action( 'wp_footer', 'vp_mobile_menu' );


/**
 * Breadcrumbs
 *
 */
function vp_breadcrumbs() {

    if( is_singular() ) {
        $hide = vp_cf( 'vp_hide_breadcrumbs' );
        if( $hide )
            return;
    }

    if ( function_exists( 'yoast_breadcrumb' ) ) {
        yoast_breadcrumb( '<div class="breadcrumbs"><div class="wrap">','</div></div>' );
    }
}
add_action( 'tha_header_after', 'vp_breadcrumbs' );

/**
 * Section Navigation
 *
 */
function vp_section_nav() {

    if( ! is_page() )
        return;

    $exclude = vp_cf( 'vp_exclude_section_nav' );
    if( $exclude )
        return;

    $section = false;
    $ancestors = get_ancestors( get_the_ID(), 'page', 'post_type' );
    $ancestors[] = get_the_ID();
    $ancestors = array_reverse( $ancestors );

    foreach( $ancestors as $page_id ) {
        $display = vp_cf( 'vp_include_section_nav', $page_id );
        if( $display )
            $section = $page_id;
    }

    if( ! $section )
        return;


    $section_nav = vp_cf( 'vp_section_nav', $section, array( 'cf_type' => 'complex' ) );
    if( empty( $section_nav ) )
        return;

    $items = array();
    foreach( $section_nav as $nav_item ) {
        $class = vp_class( 'item', 'current-menu-item', get_permalink() == $nav_item['url'] );
        $items[] = '<a href="' . esc_url( $nav_item['url'] ) . '" class="' . esc_attr( $class ) . '">' . esc_html( $nav_item['title'] ) . '</a>';
    }

    echo '<p class="section-nav">' . join( ' | ', $items ) . '</p>';
}
add_action( 'tha_entry_top', 'vp_section_nav', 15 );

/**
 * Online Visa Section Nav
 *
 */
function vp_online_visa_section_nav( $active = false ) {

    $section_nav = vp_cf( 'vp_online_visa_section_nav', 323, array( 'cf_type' => 'complex' ) );
    if( empty( $section_nav ) )
        return;

    echo '<ul class="visa-section-nav">';
    foreach( $section_nav as $i => $nav_item ) {
        $class = $active === $i ? ' class="active"' : '';
        echo '<li><a href="' . esc_url( $nav_item['url'] ) . '"' . $class . '>' . esc_html( $nav_item['title'] ) . '</a></li>';
    }
    echo '</ul>';
}

/**
 * Visa Section ID
 *
 */
function vp_visa_section_id() {

    if( ! is_page() )
        return;

    $ancestors = get_ancestors( get_the_ID(), 'page', 'post_type' );
    $ancestors[] = get_the_ID();
    $ancestors = array_reverse( $ancestors );

    $visa_section = false;
    foreach( $ancestors as $id )
        if( 'templates/visa-overview.php' == get_page_template_slug( $id ) )
            $visa_section = $id;

    return $visa_section;

}

/**
 * Visa Section Nav
 *
 */
function vp_visa_section_nav() {

    $visa_section = vp_visa_section_id();
    $section_nav = vp_cf( 'vp_online_visa_section_nav', $visa_section, array( 'cf_type' => 'complex' ) );
    if( empty( $section_nav ) )
        return;

    echo '<ul class="visa-section-nav">';
    foreach( $section_nav as $i => $nav_item ) {
        $active = $nav_item['url'] == get_permalink();
        if( 'templates/faq-answers.php' == get_page_template_slug( get_the_ID() ) && strpos( $nav_item['title'], 'FAQ' ) )
            $active = true;

        $class = $active ? ' class="active"' : '';
        echo '<li><a href="' . esc_url( $nav_item['url'] ) . '"' . $class . '>' . esc_html( $nav_item['title'] ) . '</a></li>';
    }
    echo '</ul>';
}
add_action( 'tha_entry_top', 'vp_visa_section_nav', 15 );


/**
 * Register Footer Widgets
 *
 */
function vp_register_footer_widgets() {
    for( $i = 1; $i < 6; $i++ ) {
        register_sidebar( vp_widget_area_args( array(
     		'name' => 'Footer ' . $i,
     	) ) );
    }
}
add_action( 'widgets_init', 'vp_register_footer_widgets' );

/**
 * Footer Widgets
 *
 */
function vp_footer_widgets() {
    echo '<div class="footer-widgets"><div class="wrap">';
    for( $i = 1; $i < 6; $i++ ) {
        echo '<div class="footer-widget-area" id="footer-widget-area-' . $i . '">';
        dynamic_sidebar( 'footer-' . $i );
        echo '</div>';
    }
    echo '</div></div>';
}
add_action( 'tha_footer_before', 'vp_footer_widgets' );

/**
 * Site Footer
 *
 */
function vp_site_footer() {
    echo '<p><a href="' . home_url( 'signup' ) . '">Signup</a> | <a href="' . home_url( 'contact-us' ) . '">Contact Us</a> | <a href="' . home_url( 'about/privacy-policy' ) . '">Privacy Policy</a> | <a href="' . home_url( 'about/terms-of-use' ) . '">Terms of Use</a> | <a href="' . home_url( 'site-map' ) . '">Site Map</a>  <span class="copyright">&copy; VisaPro.com</span></p>';
    echo '<p style="text-align:center;"><img src="' . get_template_directory_uri() . '/assets/images/footer-logos.jpg" /></p>';
}
add_action( 'tha_footer_top', 'vp_site_footer', 40 );

/**
 * Dictionary Nav
 *
 */
function vp_dictionary_nav() {

    $landing_id = 203;
    $loop = new WP_Query( array(
        'post_type'              => 'page',
        'post_parent'            => $landing_id,
        'posts_per_page'         => 50,
        'orderby'                => 'menu_order',
        'order'                  => 'ASC',
        'no_found_rows'          => true,
        'update_post_meta_cache' => false,
        'update_post_term_cache' => false,
    ) );
    if( ! $loop->have_posts() )
        return;

    echo '<nav class="dictionary-nav"><ul>';
    echo '<li class="' . vp_class( 'menu-item', 'current-menu-item', get_the_ID() == $landing_id ) . '"><a href="' . get_permalink( $landing_id ) . '">#</a></li>';
    while( $loop->have_posts() ): $loop->the_post();
        echo '<li class="' . vp_class( 'menu-item', 'current-menu-item', get_the_ID() == get_queried_object_id() ) . '"><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
    endwhile;
    wp_reset_postdata();
    echo '</ul></nav>';
}

/**
 * FAQ Pagination
 *
 */
function vp_faq_pagination( $total = 0, $posts_per_page = 0 ) {

    $page = isset( $_GET['vp_faq_page'] ) ? intval( $_GET['vp_faq_page'] ) : 1;
    $pages = floor( $total / $posts_per_page );
    if( 0 !== $total % $posts_per_page )
        $pages++;

    $args = array(
        'base'               => get_permalink() . '%_%',
    	'format'             => '?vp_faq_page=%#%',
    	'total'              => $pages,
    	'current'            => $page,
    	'show_all'           => false,
    	'end_size'           => 1,
    	'mid_size'           => 2,
    	'prev_next'          => true,
    	'prev_text'          => __('<'),
    	'next_text'          => __('>'),
    	'type'               => 'plain',
    	'add_args'           => false,
    	'add_fragment'       => '',
    	'before_page_number' => '',
    	'after_page_number'  => ''
    );
    echo _navigation_markup( paginate_links( $args ), 'pagination' );

}

/**
 * Simplified Header
 *
 */
function vp_simplified_header() {

    // Remove items
    remove_action( 'tha_header_before', 'vp_above_header' );
    remove_action( 'tha_header_bottom', 'vp_header_navigation' );
    remove_action( 'tha_header_after', 'vp_breadcrumbs' );
    remove_action( 'tha_footer_before', 'vp_footer_widgets' );
    remove_action( 'tha_footer_before', 'vp_site_footer', 40 );

    // Add Items
    add_action( 'tha_header_bottom', 'vp_ebook_header_phone' );
}

/**
 * Header Phone
 *
 */
function vp_ebook_header_phone() {
    $phone = vp_cf( 'vp_phone', false, array( 'type' => 'theme_option' ) );
    if( $phone )
        echo '<div class="call-us"><a href="' . vp_phone_url( $phone ) . '"><i class="icon-phone"></i> US:' . $phone . '</a></div>';

}
