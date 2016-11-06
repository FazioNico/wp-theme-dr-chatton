<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Dr._Chatton_Template
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'dr-chatton' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding container">
			<?php
			//if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<img src="<?php echo get_template_directory_uri();?>/src/img/header.png" alt="" />
			<!-- <?php
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php //echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?> -->
			<?php
				if(get_option( 'translation' ) === '1'){
			?>
				<div class="lang">
					<a href="<?php echo home_url();?>">
						<span class="fr">
							<img src="<?php echo get_template_directory_uri(); ?>/src/img/flag-fr.png" alt="langue fr" />
						</span>
					</a>
					<a href="<?php echo home_url();?>/en/index">
						<span class="en">
							<img src="<?php echo get_template_directory_uri(); ?>/src/img/flag-en.png" alt="language en" />
						</span>
					</a>
				</div>
			<?php
				}
			?>

		</div><!-- .site-branding -->

		<div class="container">
			<nav id="site-navigation" class="" role="navigation">
				<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'dr-chatton' ); ?></button> -->
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content container">
