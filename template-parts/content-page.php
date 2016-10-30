<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dr._Chatton_Template
 */

//the_title( '<h1 class="entry-title">', '</h1>' );
?>

<section id="post-<?php the_ID(); ?>"  <?php post_class('row'); ?>>
	<div class="col col-sm-8 offset-2">
		<?php
			the_content();
		?>
	</div>
</section><!-- #post Page-## -->
