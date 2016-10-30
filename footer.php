<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dr._Chatton_Template
 */

?>

	</div><!-- #content -->

	<div id="footerDivider" class="row">
		
	</div>

	<footer id="colophon" class="site-footer container" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'dr-chatton' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'dr-chatton' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'dr-chatton' ), 'dr-chatton', '<a href="http://nicolasfazio.ch" rel="designer">Nicolas Fazio</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
