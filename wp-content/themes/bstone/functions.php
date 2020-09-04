<?php
/**
 * Bstone functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bstone
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'BSTONE_THEME_VERSION', '1.2.4' );
define( 'BSTONE_THEME_SETTINGS', 'bstone-settings' );
define( 'BSTONE_THEME_DIR', get_template_directory() . '/' );
define( 'BSTONE_THEME_URI', get_template_directory_uri() . '/' );
define( 'BSTONE_SC_URI', get_template_directory_uri() . '/inc/compatibility/woocommerce/shop-customizer/' ); 

/**
 * Bstone Common Functions
 */
require_once BSTONE_THEME_DIR . 'inc/common-functions.php';
require_once BSTONE_THEME_DIR . 'inc/bstone-enqueue-scripts.php';
if ( is_rtl() ) {
	require_once BSTONE_THEME_DIR . 'inc/bstone-custom-css-rtl.php';
} else {
	require_once BSTONE_THEME_DIR . 'inc/bstone-custom-css.php';
}
require_once BSTONE_THEME_DIR . 'inc/bstone-meta-boxes.php';
require_once BSTONE_THEME_DIR . 'inc/bstone-meta-boxes-functions.php';
require_once BSTONE_THEME_DIR . 'inc/bstone-breadcrumbs.php';

/**
 * Implement the Custom Header feature.
 */
require BSTONE_THEME_DIR . 'inc/custom-header.php';

/**
 * Fonts Files & Recomended Plugins
 */
require_once BSTONE_THEME_DIR . 'inc/bstone-fonts.php';
if ( is_admin() ) {
	require_once BSTONE_THEME_DIR . 'inc/customizer/bstone-fonts-data.php';
	if ( ! in_array( 'bstone-pro/bstone-pro.php', apply_filters('active_plugins', get_option('active_plugins')) ) ) {
		require_once BSTONE_THEME_DIR . 'inc/plugins/class-tgm-plugin-activation.php';
		require_once BSTONE_THEME_DIR . 'inc/plugins/tgm-plugin-activation.php';
	}
}

/**
 * Custom template tags for this theme.
 */
require BSTONE_THEME_DIR . 'inc/template-tags.php';

/**
 * Widgets
 */
require_once BSTONE_THEME_DIR . 'inc/widgets.php';

/**
 * After Theme Setup
 */
require_once BSTONE_THEME_DIR . 'inc/core/class-after-setup-theme.php';

/**
 * Theme Hooks
 */
require_once BSTONE_THEME_DIR . 'inc/core/bstone-hooks.php';
require_once BSTONE_THEME_DIR . 'inc/core/class-bstone-options.php';
require_once BSTONE_THEME_DIR . 'inc/core/class-bstone-strings.php';

/**
 * Markup Functions
 */
require_once BSTONE_THEME_DIR . 'inc/markup.php';
require_once BSTONE_THEME_DIR . 'inc/template-parts.php';
require_once BSTONE_THEME_DIR . 'inc/core/class-bstone-loop.php';
require_once BSTONE_THEME_DIR . 'inc/blog/blog.php';
require_once BSTONE_THEME_DIR . 'inc/blog/single.php';
require_once BSTONE_THEME_DIR . 'inc/blog/blog-markup.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require BSTONE_THEME_DIR . 'inc/template-functions.php';

/**
 * Customizer additions.
 */
require BSTONE_THEME_DIR . 'inc/customizer/bstone-customizer.php';

if( class_exists( 'WooCommerce' ) ) {
	require_once BSTONE_THEME_DIR . 'inc/compatibility/woocommerce/class-bstone-woocommerce.php';
}
require_once BSTONE_THEME_DIR . 'inc/compatibility/elementor/elementor.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require BSTONE_THEME_DIR . 'inc/compatibility/jetpack.php';
}