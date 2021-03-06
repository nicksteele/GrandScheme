<?php
/**
 * The Template for displaying all single posts.
 *
 * @package GrandScheme
 * @since GrandScheme
 */

$format = get_post_format();
if ( 'image' == $format ||
	 'video' == $format ||
	 'aside' == $format ||
	 'link' == $format ||
	 'quote' == $format ||
	 'status' == $format )
	$format = get_post_format();
else
	$format = 'single';

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', $format ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
