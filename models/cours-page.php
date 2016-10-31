<?php
/**
* Template Name: Page des cours
*/

get_header();?>

<div id="primary" class="content-area">
  <main id="main" class="site-main row" role="main">

  <?php
  echo '<div class="col col-sm-3">';
  get_template_part( 'template-parts/aside', 'cours' );
  echo '</div>';
  echo '<div class="col col-sm-9">';
  echo  '<img id="selectcours" src="'.get_template_directory_uri().'/src/img/selectcours.gif" title="Selectionnez un cours">';
  echo '</div>';
?>
  </main><!-- #main -->
</div><!-- #primary -->
<?php
//get_sidebar();
get_footer();
?>
