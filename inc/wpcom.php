<?php
/**
 * WordPress.com-specific functions and definitions
 *
 * @package GrandScheme
 * @since GrandScheme 1.0
 */

global $themecolors;

/**
 * Set a default theme color array for WP.com.
 *
 * @global array $themecolors
 * @since GrandScheme 1.0
 */
$themecolors = array(
	'bg'     => 'ffffff',
	'border' => 'eeeeee',
	'text'   => '555555',
	'link'   => 'f15d5d',
	'url'    => 'f15d5d',
);


/*
 * De-queue Google fonts if custom fonts are being used instead
 */

function grandscheme_dequeue_fonts() {
	if ( class_exists( 'TypekitData' ) ) {
		if ( TypekitData::get( 'upgraded' ) ) {
			$customfonts = TypekitData::get( 'families' );
				if ( ! $customfonts )
					return;

				$site_title = $customfonts['site-title'];
				$headings = $customfonts['headings'];
				$body_text = $customfonts['body-text'];

				if ( $site_title['id'] && $headings['id'] && $body_text['id'] ) {
					//wp_dequeue_style( 'grandscheme-ProximaNova-Light' );
					wp_dequeue_style( 'grandscheme-vollkorn' );
					wp_dequeue_style( 'grandscheme-poiret-one' );
				}
		}
	}
}

add_action( 'wp_enqueue_scripts', 'grandscheme_dequeue_fonts' );
