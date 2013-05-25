<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package GrandScheme
 * @since GrandScheme 1.0
 */
?>

	</div><!-- #main -->
	<?php get_sidebar(); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php grandscheme_content_nav( 'nav-below' ); ?>
		<div class="site-info">
			<?php do_action( 'grandscheme_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'grandscheme' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'grandscheme' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Hackwork: %1$s by %2$s.', 'grandscheme' ), 'grandscheme', '<a href="http://github.com/nicksteele" rel="designer">Nick S</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
