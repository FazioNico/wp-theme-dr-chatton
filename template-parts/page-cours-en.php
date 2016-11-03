<?php
/**
 * Template part for displaying Cours index in EN.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dr._Chatton_Template
 */

   echo '<div class="row">';
   echo  '<div class="col col-sm-3 col-xs-12">';
   get_template_part( 'template-parts/aside', 'cours-en' );
   echo  '</div>';
   echo  '<div class="col col-sm-9 col-xs-12 ">';
   echo   '<p>Please select one cours.</p>';
   //echo   '<img id="selectcours" src="'.get_template_directory_uri().'/src/img/selectcours.gif" title="Selectionnez un cours">';
   echo  '</div>';
   echo '</div>';
 ?>
