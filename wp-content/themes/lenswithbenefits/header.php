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
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<!-- Typekit/Fonts -->
	<link rel="stylesheet" href="https://use.typekit.net/wgm5jfv.css">
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,600,900" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<?php
	// Getters/Setters
	$menuLeftArgs = array( 'menu' => 'left-menu' );
	$menuRightArgs = array( 'menu' => 'right-menu' );
	$mobileMenuArgs = array( 'menu' => 'mobile-menu' );

?>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'lenswithbenefits' ); ?></a>

	<header id="masthead" class="site-header">

		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<!-- Left Side Menu -->
					<?php wp_nav_menu($menuLeftArgs); ?>
				</div>
				<div class="col-md-2">
					<!-- Logo Here -->
					<div class="logo-area">
						<a href="<?php echo get_home_url(); ?>">
							<img class="logo" src="http://via.placeholder.com/350x150" />
							<!-- <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Lens With Benefits Logo">  -->
						</a>
					</div>
					<div class="moby-menu-toggle">
						<span id="moby-button">
							<i class="material-icons">menu</i>
						</span>
					</div>
				</div>
				<div class="col-md-5">
					<!-- Right Side Menu -->
					<?php wp_nav_menu($menuRightArgs); ?>
				</div>
			</div>
		</div>

		<div class="mobile-menu">
			<?php wp_nav_menu($mobileMenuArgs); ?>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
