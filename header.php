<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package GrandScheme
 * @since GrandScheme 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '', true, 'left' ); ?></title>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<script type="text/javascript">
       $(document).bind('ready', function () {
           $('.js-subscribe-loader', 'body').Modal();
       }); </script>
<?php wp_head(); ?>
</head>

<div class="ui-shwoop">
<div class="subscribe">Subscribe</div>
	<div class="content">
		<?php $subsPref = array(
                        'prepend' => '',
                        'showname' => false,
                        'nametxt' => 'Name:',
                        'nameholder' => 'Name...',
                        'emailtxt' => '',
                        'emailholder' => ' Email Address',
                        'showsubmit' => true,
                        'submittxt' => 'Subscribe to Our Blog',
                        'jsthanks' => false,
                        'thankyou' => 'Thank you for subscribing to our mailing list');
                        echo smlsubform($subsPref); ?> <!-- #subscribe -->
	</div>
</div>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header">
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) { ?>
			<a class="logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
			</a>
		<?php } ?>
		<nav id="site-navigation" class="navigation-main" role="navigation">
                        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                </nav>
		<!-- #site-navigation -->
		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>
	</header>
	<!-- #masthead -->

<div id="main" class="site-main">
