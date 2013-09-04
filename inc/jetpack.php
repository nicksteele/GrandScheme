<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package GrandScheme
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
/**
function grandscheme_infinite_scroll_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container'  => 'content',
		'footer'     => 'page',
		'footer_widgets' => 'infinite_scroll_has_footer_widgets',
	) );
}
add_action( 'after_setup_theme', 'grandscheme_infinite_scroll_setup' );

if ( function_exists( 'jetpack_is_mobile' ) ) {
	function grandscheme_infinite_scroll_has_footer_widgets() {
		if ( jetpack_is_mobile( '', true ) && is_active_sidebar( 'primary-sidebar' ) )
			return true;

		return false;
	}
	add_filter( 'infinite_scroll_has_footer_widgets', 'grandscheme_infinite_scroll_has_footer_widgets' );
}
*/
