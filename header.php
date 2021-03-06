<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package skycraft
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'skycraft_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<section class="hero overflow-hidden" style="background-image: url(<?php echo header_image(); ?>)">

		<?php if ( 'container' == $container ) : ?>
		<div class="container">
		<?php endif; ?>

		<div class="row align-items-center" style="min-height: 70vh">
			<div class="col-md-6 text-center text-md-left">
				<?php if ( ! has_custom_logo() ) { ?>
					<h1 class="title"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
				<?php } else {
					the_custom_logo();
				} ?><!-- end custom logo -->
			</div>
			<div class="col-md-6">
				<?php skycraft_serversign(); ?>
			</div>
		</div>

		<?php if ( 'container' == $container ) : ?>
		</div><!-- .container -->
		<?php endif; ?>

	</section>

<div class="navbar-wrapper sticky-top">
<nav class="navbar navbar-expand-md navbar-dark">

<?php if ( 'container' == $container ) : ?>
	<div class="container">
<?php endif; ?>

			<!-- Your site title as branding in the menu -->
			<?php if ( ! has_custom_logo() ) { ?>
				<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>
			<?php } else {
				the_custom_logo();
			} ?><!-- end custom logo -->

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'skycraft' ); ?>">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- The WordPress Menu goes here -->
		<?php wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'container_class' => 'collapse navbar-collapse',
				'container_id'    => 'navbarNavDropdown',
				'menu_class'      => 'navbar-nav ml-auto',
				'fallback_cb'     => '',
				'menu_id'         => 'main-menu',
				'depth'           => 2,
				'walker'          => new skycraft_WP_Bootstrap_Navwalker(),
			)
		); ?>

	<?php if ( 'container' == $container ) : ?>
	</div><!-- .container -->
	<?php endif; ?>
</nav><!-- .site-navigation -->
<div class="block-bottom stone">
		<span class="left"></span>
		<span class="middle">
			<span></span>
		</span>
		<span class="right"></span>
	</div>
</div>
