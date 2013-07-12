<?php
/**
 * @package GrandScheme
 * @since GrandScheme 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
	        <div class="entry-meta">
                        <?php grandscheme_posted_on(); ?>
                        <?php edit_post_link( __( 'Edit', 'grandscheme' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- .entry-meta -->
		<div class="ui-auth-info">
	                <div class="ui-auth-pic"><?php echo get_avatar( get_the_author_email(), '72' ); ?></div>
               		<div class="ui-auth-desc"><?php echo get_the_author_meta('user_description',get_query_var('author') )?></div>
		</div>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'grandscheme' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<?php if ( 'post' == get_post_type() ) : ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() || '' != get_the_post_thumbnail() && ! get_post_format() ) : // Only display Excerpts for Search; only display excerpts when post thumbnails are assigned and the post is not a formatted post ?>
	<div class="entry-summary">
		<?php if ( ! is_search() ) : ?>
			<?php the_post_thumbnail(); ?>
		<?php endif; ?>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'grandscheme' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'grandscheme' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ' ', 'grandscheme' ) );
				if ( $categories_list && grandscheme_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php echo $categories_list; ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '' );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php echo $tags_list; ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>
		 <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                        <span class="comments-link"><?php comments_popup_link( __( '0', 'grandscheme' ), __( '1', 'grandscheme' ), __( '%', 'grandscheme' ) ); ?></span>
                 <?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
