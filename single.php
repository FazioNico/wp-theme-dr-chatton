<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Dr._Chatton_Template
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main  cours-single" role="main">

		<?php
		echo '<div class="row">';
	  echo  '<div class="col col-sm-3 col-xs-12">';
	  get_template_part( 'template-parts/aside', 'cours' );
	  echo  '</div>';
	  echo  '<div class="col col-sm-9 col-xs-12">';

		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_format() );
			//the_post_navigation();
			// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;
		endwhile; // End of the loop.

	  echo  '</div>';
	  echo '</div>';
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
