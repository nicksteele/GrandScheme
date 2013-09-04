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
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- #tracking -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-37651332-2', 'grandst.com');
  ga('send', 'pageview');

</script>

</body>
</html>
