<?php
/**
 * @package GrandScheme
 * @since GrandScheme 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @uses grandscheme_header_style()
 * @uses grandscheme_admin_header_style()
 * @uses grandscheme_admin_header_image()
 *
 * @package GrandScheme
 */
function grandscheme_custom_header_setup() {
	$args = array(
		'default-image'          => get_template_directory_uri() . '/img/logo-left-of-text.png',
		'default-text-color'     => '49352f',
		'width'                  => 790,
		'height'                 => 200,
		'flex-height'            => true,
		'flex-width'		 => true,
		'wp-head-callback'       => 'grandscheme_header_style',
		'admin-head-callback'    => 'grandscheme_admin_header_style',
		'admin-preview-callback' => 'grandscheme_admin_header_image',
	);

	$args = apply_filters( 'grandscheme_custom_header_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-header', $args );
	} else {
		// Compat: Versions of WordPress prior to 3.4.
		define( 'HEADER_TEXTCOLOR',    $args['default-text-color'] );
		define( 'HEADER_IMAGE',        $args['default-image'] );
		define( 'HEADER_IMAGE_WIDTH',  $args['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $args['height'] );
		add_custom_image_header( $args['wp-head-callback'], $args['admin-head-callback'], $args['admin-preview-callback'] );
	}
}
add_action( 'after_setup_theme', 'grandscheme_custom_header_setup' );

/**
 * Shiv for get_custom_header().
 *
 * get_custom_header() was introduced to WordPress
 * in version 3.4. To provide backward compatibility
 * with previous versions, we will define our own version
 * of this function.
 *
 * @return stdClass All properties represent attributes of the curent header image.
 *
 * @package GrandScheme
 * @since GrandScheme v1.0
 */

if ( ! function_exists( 'get_custom_header' ) ) {
	function get_custom_header() {
		return (object) array(
			'url'           => get_header_image(),
			'thumbnail_url' => get_header_image(),
			'width'         => HEADER_IMAGE_WIDTH,
			'height'        => HEADER_IMAGE_HEIGHT,
		);
	}
}

if ( ! function_exists( 'grandscheme_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see grandscheme_custom_header_setup().
 *
 * @since GrandScheme 1.0
 */
function grandscheme_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		.site-title,
		.site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // grandscheme_header_style

if ( ! function_exists( 'grandscheme_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see grandscheme_custom_header_setup().
 *
 * @since GrandScheme 1.0
 */
function grandscheme_admin_header_style() {
?>
	<style type="text/css">
	.appearance_page_custom-header #headimg {
		border: none;
	}
	#headimg h1 {
		clear: both;
		font-family: "Berkshire Swash", sans-serif;
		font-weight: normal;
		line-height: normal;
		margin: 0;
	}
	#headimg h1 a {
		text-decoration: none;
	}
	#desc {
		clear: both;
		color: #f15d5d !important;
		font-family: Gudea, Helvetica, Arial, sans-serif;
		margin: 5px 0 27px 5px;
	}
<?php
	if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
	#headimg h1 {
		font-size: 52px;
		text-align: center;
	}
	#desc {
		font-size: 24px;
		text-align: center;
	}
	.appearance_page_custom-header #headimg {
		max-width: 790px;
	}
<?php else : ?>
	#headimg h1 {
		font-size: 48px;
	}
	#desc {
		font-size: 18px;
	}
	.appearance_page_custom-header #headimg {
		max-width: 600px;
	}
<?php endif; ?>
	#headimg img {
		clear: both;
		display: block;
		max-width: 100%;
		height: auto;
		margin: 0 auto 1.5em;
	}
	</style>
<?php
}
endif; // grandscheme_admin_header_style

if ( ! function_exists( 'grandscheme_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see grandscheme_custom_header_setup().
 *
 * @since GrandScheme 1.0
 */
function grandscheme_admin_header_image() { ?>
	<div id="headimg">
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif;

		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
	</div>
<?php }
endif; // grandscheme_admin_header_image
