<?php
/**
 * GrandScheme functions and definitions, Still based off derm
 *
 * @package GrandScheme
 * @since GrandScheme 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since GrandScheme 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 700; /* pixels. originally 560 */

/**
 * Set a new content_width if using the wide page template
 */
function grandscheme_content_width() {
	global $content_width;
	if ( is_page_template( 'nosidebar-page.php' ) )
		$content_width = 750;
}
add_action( 'template_redirect', 'grandscheme_content_width' );

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( 'grandscheme_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since GrandScheme 1.0
 */
function grandscheme_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	//require( get_template_directory() . '/inc/wpcom.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Pachyderm, use a find and replace
	 * to change 'pachyderm' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'grandscheme', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'grandscheme' ),
	) );

	/**
	 * Add support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'status', 'audio', 'chat', 'gallery' ) );

	/**
	*Add support for Post Authors
	*/
	/*add_author_support('post-authors', array('aside', 'joe', 'amanda', 'nick', 'aaron', 'cadran', 'kuan', 'craig', 'dustin' ) );*/

	/**
	* Add support for editor style
	*/
	add_editor_style();

	/**
	* Add support for post thumbs
	*/
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true );

	/**
	 * Setup the WordPress core custom background feature.
	 *
	 * Use add_theme_support to register support for WordPress 3.4+
	 * as well as provide backward compatibility for previous versions.
	 * Use feature detection of wp_get_theme() which was introduced
	 * in WordPress 3.4.
	 *
	 * Hooks into the after_setup_theme action.
	 *
	 * @since GrandScheme 1.0
	 */

	$args = array(
		'default-color' => 'ffffff',
		'default-image' => get_template_directory_uri() . '/img/background.png',
);

	$args = apply_filters( 'grandscheme_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}

}
endif; // grandscheme_setup
add_action( 'after_setup_theme', 'grandscheme_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since GrandScheme 1.0
 */
function grandscheme_widgets_init() {

	register_sidebar( array(
		'id' => 'primary-sidebar',
		'name' => __( 'Primary Sidebar' , 'grandscheme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clear">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>'
		)
	);

}
add_action( 'widgets_init', 'grandscheme_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function grandscheme_scripts() {

	global $post;

	wp_enqueue_style( 'grandscheme-style', get_stylesheet_uri() );

	//wp_enqueue_style( 'grandscheme-ProximaNova' );
	wp_enqueue_style( 'grandscheme-Vollkorn' );
	wp_enqueue_style( 'grandscheme-poiret-one' );

	wp_enqueue_script( 'navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', 'grandscheme_scripts' );


/*
 * Register Google Fonts
 */
function grandscheme_fonts() {

	$protocol = is_ssl() ? 'https' : 'http';


	/* translators: If there are characters in your langauge unsupported by any of the following fonts, translate the option to 'off', do not translate into your own language! */

	if ( 'off' !== _x( 'on', 'Vollkorn font: on or off', 'grandscheme' ) ) {

		wp_register_style( 'grandscheme-vollkorn', "$protocol://fonts.googleapis.com/css?family=Vollkorn:400italic,700italic,400,700&subset=latin" );

	}

	/*	translators: If there are characters in your language that are not supported
		by Poiret One, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Poiret One font: on or off', 'grandscheme' ) ) {

		wp_register_style( 'grandscheme-poiret-one', "$protocol://fonts.googleapis.com/css?family=Poiret+One&subset=latin,latin-ext,cyrillic" );

	}

	/*	translators: If there are characters in your language that are not supported
		by Gudea, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Gudea font: on or off', 'grandscheme' ) ) {

		wp_register_style( 'grandscheme-gudea', "$protocol://fonts.googleapis.com/css?family=Gudea:400,400italic,700&subset=latin,latin-ext" );

	}

}
add_action( 'init', 'grandscheme_fonts' );


/**
 * Change excerpt [...] to a Continue Reading link
 **/

function grandscheme_new_excerpt_more( $more ) {
    global $post;
	return '...<br /><a class="more-link" href="'. get_permalink( $post->ID ) . __( '">Continue reading &raquo;</a>', 'grandscheme' );
}
add_filter( 'excerpt_more', 'grandscheme_new_excerpt_more' );


/**
 * Enqueue Google Fonts for custom headers
 */
function grandscheme_admin_scripts( $hook_suffix ) {

	if ( 'appearance_page_custom-header' != $hook_suffix )
		return;

	wp_enqueue_style( 'pachyderm-gudea' );
	wp_enqueue_style( 'pachyderm-berkshire-swash' );

}
add_action( 'admin_enqueue_scripts', 'grandscheme_admin_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );
