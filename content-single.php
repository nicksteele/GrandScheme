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
                        <?php edit_post_link( __( 'Edit', 'grandscheme' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
                </div><!-- .entry-meta -->
		<div class="ui-auth-info">
                        <div class="ui-auth-pic"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_email(), '72' ); ?></a></div>
			<div class="ui-auth-desc">
                               <div class="ui-auth-name"> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                        <?php echo get_the_author_meta('first_name',get_query_var('author'))?></a></div>
                                <?php echo get_the_author_meta('user_description',get_query_var('author') )?>
                        </div>
                </div>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'grandscheme' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
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
                 <?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
                        <span class="comments-link"><?php comments_popup_link( __( '0', 'grandscheme' ), __( '1', 'grandscheme' ), __( '%', 'grandscheme' ) ); ?></span>
                 <?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
