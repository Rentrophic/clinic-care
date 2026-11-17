<?php
/**
 * Clinic Care theme functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CLINIC_CARE_VERSION', '1.0.0' );

function clinic_care_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-logo', array( 'height' => 48, 'width' => 200, 'flex-width' => true, 'flex-height' => true ) );
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'clinic-care' ),
			'footer'  => __( 'Footer Menu', 'clinic-care' ),
		)
	);
	set_post_thumbnail_size( 800, 450, true );
}
add_action( 'after_setup_theme', 'clinic_care_setup' );

function clinic_care_assets() {
	wp_enqueue_style( 'clinic-care-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', array(), null );
	wp_enqueue_style( 'clinic-care', get_stylesheet_uri(), array( 'clinic-care-fonts' ), CLINIC_CARE_VERSION );
	wp_enqueue_script( 'clinic-care', get_template_directory_uri() . '/theme.js', array(), CLINIC_CARE_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'clinic_care_assets' );

function clinic_care_resource_hints( $urls, $relation ) {
	if ( 'preconnect' === $relation ) {
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'clinic_care_resource_hints', 10, 2 );

/**
 * Use the menu created by the Clinic Portal plugin until the owner picks another.
 */
function clinic_care_assign_menu() {
	$locations = get_theme_mod( 'nav_menu_locations', array() );
	$menu_id   = (int) get_option( 'clinic_portal_menu_id' );
	if ( $menu_id && empty( $locations['primary'] ) && wp_get_nav_menu_object( $menu_id ) ) {
		$locations['primary'] = $menu_id;
		if ( empty( $locations['footer'] ) ) {
			$locations['footer'] = $menu_id;
		}
		set_theme_mod( 'nav_menu_locations', $locations );
	}
}
add_action( 'init', 'clinic_care_assign_menu', 30 );
add_action( 'after_switch_theme', 'clinic_care_assign_menu' );

/**
 * Fallback menu if none is assigned: the clinic pages.
 */
function clinic_care_fallback_menu() {
	$items = array(
		'home'                 => 'Home',
		'physicians'           => 'Physicians',
		'departments-services' => 'Services',
		'book-appointment'     => 'Appointments',
		'patient-registration' => 'Register',
		'announcements-faq'    => 'News and FAQ',
		'contact-us'           => 'Contact',
	);
	echo '<ul class="menu">';
	foreach ( $items as $slug => $label ) {
		$url = function_exists( 'clinic_page_url' ) ? clinic_page_url( $slug ) : home_url( 'home' === $slug ? '/' : '/' . $slug . '/' );
		echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * Clinic details with safe defaults if the plugin is not active.
 */
function clinic_care_opt( $key ) {
	if ( function_exists( 'clinic_opt' ) ) {
		return clinic_opt( $key );
	}
	$defaults = array(
		'clinic_name'     => get_bloginfo( 'name' ),
		'phone'           => '',
		'emergency_phone' => '',
		'email'           => get_option( 'admin_email' ),
		'address'         => '',
	);
	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
}

function clinic_care_url( $slug ) {
	return function_exists( 'clinic_page_url' ) ? clinic_page_url( $slug ) : home_url( 'home' === $slug ? '/' : '/' . $slug . '/' );
}

function clinic_care_icon( $name, $size = 18 ) {
	return function_exists( 'clinic_icon' ) ? clinic_icon( $name, $size ) : '';
}

function clinic_care_brand_mark() {
	return '<span class="site-brand__mark" aria-hidden="true"><svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="M12 4v16M4 12h16"/></svg></span>';
}

function clinic_care_excerpt_more() {
	return '...';
}
add_filter( 'excerpt_more', 'clinic_care_excerpt_more' );

/**
 * True when the page content is built from Clinic Portal shortcodes.
 */
function clinic_care_is_portal_page( $post = null ) {
	$post = get_post( $post );
	return $post && false !== strpos( $post->post_content, '[clinic_' );
}
