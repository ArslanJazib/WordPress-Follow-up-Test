<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site-wrapper">

	<!-- Top Bar (Secondary Menu) -->
	<div class="top-bar bg-orange text-white py-1">
		<div class="container d-flex justify-content-between align-items-center flex-wrap">
			<div class="call-text small">
				<span class="fw-bold alt-label">CALL US NOW!</span>
				<span class="ms-2"><?php echo get_option('theme_phone'); ?></span>
			</div>
			<div class="top-menu small">
				<?php
				wp_nav_menu([
					'theme_location' => 'top-menu',
					'menu_class' => 'list-inline mb-0 top-nav',
					'container' => false,
					'depth' => 1,
					'fallback_cb' => false,
					'link_before' => '<span>',
					'link_after' => '</span>',
					'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				]);
				?>
			</div>
		</div>
	</div>

	<!-- Header with Logo and Primary Nav -->
	<header id="masthead" class="site-header bg-light py-3 border-bottom">
		<div class="container d-flex justify-content-between align-items-center flex-wrap">

			<!-- Logo Area -->
			<div class="site-logo">
				<?php
				$logo_url = get_option('theme_logo');
				if ( $logo_url ) :
				?>
					<a href="<?php echo esc_url(home_url('/')); ?>">
						<img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>" style="max-height: 60px;">
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="site-title fw-bold text-dark text-decoration-none">
						<?php bloginfo('name'); ?>
					</a>
				<?php endif; ?>
			</div>

			<!-- Primary Navigation -->
			<nav class="navbar navbar-expand-lg">
			<div class="container">
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<?php
					wp_nav_menu([
						'theme_location' => 'primary-menu',
						'container'      => false,
						'menu_class'     => 'navbar-nav ms-auto',
						'fallback_cb'    => false,
						'depth'          => 3,
						'walker'         => new Custom_Nav_Walker()
					]);
				?>
				</div>
			</div>
			</nav>

		</div>
	</header>

	<!-- Main Content Wrapper -->
	<main id="content" class="site-content mt-4">