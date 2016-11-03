<?php
/**
* Template Name: Single EN Page
*/

get_header('en');
$class = ' cours-page';
?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main <?php if (is_single('83') == 1){ echo ' cours-page';}?>" role="main">
			<?php
			while ( have_posts() ) : the_post();
				if (is_single('83') == 1){
					get_template_part( 'template-parts/page', 'cours-en' );
				}
				else{
					get_template_part( 'template-parts/content', 'page' );
				}

			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
//get_sidebar();
get_footer();
?>
