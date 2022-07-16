<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aecc
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<!-- Bootstrap -->
	<script src="https://kit.fontawesome.com/21b5a126d9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/app.css" rel="stylesheet">	
	
</head>

<body <?php body_class(); ?>>

	<?php wp_body_open(); ?>

		<div id="page" class="site">

		<div class="d-flex" id="wrapper">

			<!-- Sidebar -->
			<div class="bg-aecc border-right" id="sidebar-wrapper">

			<div class="sidebar-heading">
				<?php the_custom_logo(); ?>
			</div>

			<!-- Widget::Primary Menu Widget -->
			<?php if ( is_active_sidebar( 'primary-menu-widget' )  ) : ?>

			<div class="widget-area primary-menu-widget-area" role="complementary">
				<?php dynamic_sidebar( 'primary-menu-widget' ); ?>
			</div>

			<?php endif; ?>


			<div class="list-group list-group-flush">
			
				<?php
				wp_nav_menu(
					array(
						'theme_location' 	=> 'menu-1',
						'menu_id'        	=> 'primary-menu',
						'menu_class'		=> '',
						'add_li_class'  	=> 'list-group-item list-group-item-action bg-light'
					)
				);
				?>

			</div>
			</div>
			<!-- /#sidebar-wrapper -->

			<!-- Page Content -->
			<div id="page-content-wrapper">

				<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<!-- <button class="btn btn-primary" id="menu-toggle"></button> -->
				<i class="fas fa-bars" id="menu-toggle"></i>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
					<li class="nav-item active">
						<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Link</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Dropdown
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</li>
					</ul>
				</div>
				</nav>
