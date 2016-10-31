<?php
/**
* Template Name: Page des cours
*/

get_header();?>

<div id="primary" class="content-area">
  <main id="main" class="site-main cours-page" role="main">

  <?php
  echo '<div class="row">';
  echo  '<div class="col col-sm-3 col-xs-12">';
  get_template_part( 'template-parts/aside', 'cours' );
  echo  '</div>';
  echo  '<div class="col col-sm-9 col-xs-12">';
  echo   '<img id="selectcours" src="'.get_template_directory_uri().'/src/img/selectcours.gif" title="Selectionnez un cours">';
  echo  '</div>';
  echo '</div>';
?>
  </main><!-- #main -->
</div><!-- #primary -->
<?php
//get_sidebar();
get_footer();
?>
