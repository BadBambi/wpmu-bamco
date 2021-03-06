<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package mise
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mise_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	
	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-classic' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'mise_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function mise_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'mise_pingback_header' );

/* Output of breadcrumb */
function mise_the_breadcrumb() {
	if ( function_exists('yoast_breadcrumb') && mise_check_for_breadcrumb() ) {
		yoast_breadcrumb( '<p id="breadcrumbs" class="mise-breadcrumbs smallText">','</p>' );
	}
	if (function_exists('rank_math_the_breadcrumbs') && mise_check_for_breadcrumb() ) {
		rank_math_the_breadcrumbs();
	}
}

/* Check for the breadcrumb */
function mise_check_for_breadcrumb() {
	if (is_page_template('template-onepage.php')) {
		return false;
	}
	return apply_filters( 'mise_the_breadcrumb_filter', true );
}
