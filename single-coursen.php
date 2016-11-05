<?php
/**
* Template Name: Single EN Page
*/

get_header('en');
$class = ' cours-page';
?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main   cours-single <?php if (is_single('83') == 1){ echo ' cours-page';}?>" role="main">
		<?php
			echo '<div class="row">';
		  echo  '<div class="col col-sm-3 col-xs-12">';
		  get_template_part( 'template-parts/aside', 'cours-en' );
		  echo  '</div>';
		  echo  '<div class="col col-sm-9 col-xs-12">';

			while ( have_posts() ) : the_post();
				if (is_single('83') == 1){
					get_template_part( 'template-parts/page', 'cours-en' );
				}
				else{
					get_template_part( 'template-parts/content' );
				}

			endwhile; // End of the loop.
	
		  echo  '</div>';
		  echo '</div>';
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
//get_sidebar();
get_footer();
?>
