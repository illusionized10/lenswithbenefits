<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lenswithbenefits
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php

// Getters/Setters

$menuLeftArgs = array( 'menu' => 'left-menu' );
$menuRightArgs = array( 'menu' => 'right-menu' );

?>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lenswithbenefits' ); ?></a>

	<header id="masthead" class="site-header">

		<div class="container">
			<div class="row">
				<div class="col-sm-5">
					<!-- Left Side Menu -->
					<?php wp_nav_menu($menuLeftArgs); ?>
				</div>
				<div class="col-sm-2">
					<!-- Logo Here -->
					
				</div>
				<div class="col-sm-5">
					<!-- Right Side Menu -->
					<?php wp_nav_menu($menuRightArgs); ?>
				</div>
			</div>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
