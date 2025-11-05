<?php
/**
 * Lots of Help — Functions Orchestrator
 *
 * This file conducts the symphony.
 * Every function serves a purpose.
 * No bloat. No cleverness for cleverness' sake.
 *
 * @package LotsOfHelp
 * @since 1.0.0
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme Setup — The Foundation
 *
 * Like a well-designed building, we start with solid foundations.
 */
function lotsofhelp_setup() {
	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Enable post thumbnails — every story deserves an image
	add_theme_support( 'post-thumbnails' );

	// Enable custom logo — your identity, beautifully displayed
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	// Register navigation menus — pathways through the site
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'lotsofhelp' ),
		'footer'  => __( 'Footer Navigation', 'lotsofhelp' ),
	) );

	// Add support for HTML5 markup — semantic, modern, accessible
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Add support for selective refresh for widgets
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for responsive embeds
	add_theme_support( 'responsive-embeds' );

	// Add support for editor styles
	add_theme_support( 'editor-styles' );

	// Add support for wide and full alignment
	add_theme_support( 'align-wide' );

	// Set content width — optimal reading experience
	$GLOBALS['content_width'] = 720;
}
add_action( 'after_setup_theme', 'lotsofhelp_setup' );

/**
 * Enqueue Scripts and Styles — Only What's Needed
 *
 * Performance is a feature.
 * Every byte matters.
 */
function lotsofhelp_scripts() {
	// Main stylesheet
	wp_enqueue_style(
		'lotsofhelp-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);

	// Custom stylesheet (if it exists)
	if ( file_exists( get_template_directory() . '/assets/css/main.css' ) ) {
		wp_enqueue_style(
			'lotsofhelp-main',
			get_template_directory_uri() . '/assets/css/main.css',
			array( 'lotsofhelp-style' ),
			wp_get_theme()->get( 'Version' )
		);
	}

	// Main JavaScript — enhancement, not requirement
	if ( file_exists( get_template_directory() . '/assets/js/main.js' ) ) {
		wp_enqueue_script(
			'lotsofhelp-main',
			get_template_directory_uri() . '/assets/js/main.js',
			array(),
			wp_get_theme()->get( 'Version' ),
			true // Load in footer
		);
	}

	// Comment reply script when needed
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lotsofhelp_scripts' );

/**
 * Register Widget Areas — Spaces for Flexible Content
 */
function lotsofhelp_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'lotsofhelp' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'lotsofhelp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer', 'lotsofhelp' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'lotsofhelp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'lotsofhelp_widgets_init' );

/**
 * Custom Excerpt Length — Respect Attention
 *
 * Long enough to intrigue, short enough to respect time.
 */
function lotsofhelp_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'lotsofhelp_excerpt_length' );

/**
 * Custom Excerpt More — Invitation to Continue
 */
function lotsofhelp_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'lotsofhelp_excerpt_more' );

/**
 * Add Custom Body Classes — Context-Aware Styling
 */
function lotsofhelp_body_classes( $classes ) {
	// Add class when there's a featured image
	if ( is_singular() && has_post_thumbnail() ) {
		$classes[] = 'has-featured-image';
	}

	// Add class for no sidebar
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'lotsofhelp_body_classes' );

/**
 * Time to Read — Helpful Context
 *
 * Let readers know the commitment they're making.
 */
function lotsofhelp_reading_time() {
	$content = get_post_field( 'post_content', get_the_ID() );
	$word_count = str_word_count( strip_tags( $content ) );
	$reading_time = ceil( $word_count / 200 ); // Average reading speed

	if ( $reading_time === 1 ) {
		return '1 minute read';
	}

	return $reading_time . ' minute read';
}

/**
 * Post Navigation — Connection Between Stories
 */
function lotsofhelp_post_navigation() {
	if ( ! is_singular( 'post' ) ) {
		return;
	}

	the_post_navigation( array(
		'prev_text' => '<span class="nav-subtitle">' . __( 'Previous Story', 'lotsofhelp' ) . '</span><span class="nav-title">%title</span>',
		'next_text' => '<span class="nav-subtitle">' . __( 'Next Story', 'lotsofhelp' ) . '</span><span class="nav-title">%title</span>',
	) );
}

/**
 * Pagination — Navigate the Archive
 */
function lotsofhelp_pagination() {
	the_posts_pagination( array(
		'mid_size'  => 2,
		'prev_text' => __( '&larr; Previous', 'lotsofhelp' ),
		'next_text' => __( 'Next &rarr;', 'lotsofhelp' ),
	) );
}

/**
 * Include Additional Files — Organized Concerns
 *
 * As the theme grows, we maintain clarity through organization.
 */
// require_once get_template_directory() . '/inc/customizer.php';
// require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Remove WordPress Bloat — Simplify Ruthlessly
 *
 * Every request saved is a gift to the user.
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Remove Windows Live Writer support
remove_action( 'wp_head', 'wlwmanifest_link' );

// Remove RSD link
remove_action( 'wp_head', 'rsd_link' );

// Remove WordPress version
remove_action( 'wp_head', 'wp_generator' );

/**
 * Security Headers — Protect Our Community
 */
function lotsofhelp_security_headers() {
	header( 'X-Content-Type-Options: nosniff' );
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'X-XSS-Protection: 1; mode=block' );
}
add_action( 'send_headers', 'lotsofhelp_security_headers' );

/**
 * That's it.
 *
 * Simple. Elegant. Purposeful.
 * We ship only what we are proud of.
 */
