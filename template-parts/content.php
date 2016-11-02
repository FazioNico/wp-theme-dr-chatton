<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Dr._Chatton_Template
 */


  $customMetaPost = get_post_custom($post->ID);
	$dates = $customMetaPost["dates"][0];
	$formateurs = $customMetaPost["formateurs"][0];
  $file = $customMetaPost["attached_pdf"][0];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		// if ( is_single() ) :
		// 	the_title( '<h1 class="entry-title">', '</h1>' );
		// else :
		// 	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		// endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php dr_chatton_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="row">
			<div class="col col-sm-4">
				<p class="cours-title">
					<i>Thème:</i>
				</p>
			</div>
			<div class="col col-sm-8">
				<?php the_title( '<h1 class="cours-title"><strong>', '</strong></h1>' );?>
			</div>
		</div>
		<div class="row">
			<div class="col col-sm-4">
				<p class="cours-title">
					<i>Dates:</i>
				</p>
			</div>
			<div class="col col-sm-8">
				<?php print_r('<p class="cours-title">'.$dates.'</p>');?>
			</div>
		</div>
		<div class="row">
			<div class="col col-sm-4">
				<p class="cours-title">
					<i>Formateurs:</i>
				</p>
			</div>
			<div class="col col-sm-8">
				<?php print_r('<p class="cours-title">'.$formateurs.'</p>');?>
			</div>
		</div>
		<div class="row">
			<div class="col col-sm-12">
				<br>
				<p class="cours-title">
					<i>Commentaires</i>
				</p>
				<?php
					the_content();
				?>
				<p>
					<a href="<?php echo wp_get_attachment_url($file);?>" target="_blank">Télécharger le fichier associé</a>
				</p>
			</div>
		</div>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
