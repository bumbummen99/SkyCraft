<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package skycraft
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_filter( 'body_class', 'skycraft_body_classes' );

if ( ! function_exists( 'skycraft_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function skycraft_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
}

// Removes tag class from the body_class array to avoid Bootstrap markup styling issues.
add_filter( 'body_class', 'skycraft_adjust_body_class' );

if ( ! function_exists( 'skycraft_adjust_body_class' ) ) {
	/**
	 * Setup body classes.
	 *
	 * @param string $classes CSS classes.
	 *
	 * @return mixed
	 */
	function skycraft_adjust_body_class( $classes ) {

		foreach ( $classes as $key => $value ) {
			if ( 'tag' == $value ) {
				unset( $classes[ $key ] );
			}
		}

		return $classes;

	}
}

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'skycraft_change_logo_class' );

if ( ! function_exists( 'skycraft_change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return mixed
	 */
	function skycraft_change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"', $html );

		return $html;
	}
}

add_filter('next_post_link', 'skycraft_post_link_attributes');
add_filter('previous_post_link', 'skycraft_post_link_attributes');
if ( ! function_exists ( 'skycraft_post_link_attributes' ) ) {
	function skycraft_post_link_attributes($output) {
		$code = 'class="btn btn-secondary"';
		return str_replace('<a href=', '<a '.$code.' href=', $output);
	}
}

/**
 * Display navigation to next/previous post when applicable.
 */

if ( ! function_exists ( 'skycraft_post_nav' ) ) {
	function skycraft_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
		<nav class="container navigation post-navigation">
			<h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'skycraft' ); ?></h2>
			<div class="row nav-links justify-content-between mb-3">
				<?php
				echo '<span class="nav-previous">';
				if ( get_previous_post_link() ) {
					previous_post_link( '%link', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'skycraft' ) );
				}
				echo '</span>';
				echo '<span class="nav-next">';
				if ( get_next_post_link() ) {
					next_post_link( '%link', _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'skycraft' ) );
				}
				echo '</span>';
				?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( ! function_exists( 'skycraft_pingback' ) ) {
	/**
	 * Add a pingback url auto-discovery header for single posts of any post type.
	 */
	function skycraft_pingback() {
		if ( is_singular() && pings_open() ) {
			echo '<link rel="pingback" href="' . esc_url( get_bloginfo( 'pingback_url' ) ) . '">' . PHP_EOL;
		}
	}
}
add_action( 'wp_head', 'skycraft_pingback' );

if ( ! function_exists( 'skycraft_mobile_web_app_meta' ) ) {
	/**
	 * Add mobile-web-app meta.
	 */
	function skycraft_mobile_web_app_meta() {
		echo '<meta name="mobile-web-app-capable" content="yes">' . PHP_EOL;
		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . PHP_EOL;
		echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . PHP_EOL;
	}
}
add_action( 'wp_head', 'skycraft_mobile_web_app_meta' );


use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;


if ( ! function_exists( 'skycraft_serversign' ) ) {
	/**
	 * Add mobile-web-app meta.
	 */
	function skycraft_serversign() {
		if (get_theme_mod( 'skycraft_container_type' )) {
			// Query Server
			$status = true;
			$statusImage = '/img/online.png';
			$cacheKey = 'skycraft-query-data' . get_theme_mod('skycraft_serversign_address') . get_theme_mod('skycraft_serversign_port');
			wp_cache_delete( $cacheKey, '' );
			$data = wp_cache_get($cacheKey, '');
			if (!$data) {
				try
				{
					$query = new MinecraftPing( get_theme_mod('skycraft_serversign_address'), get_theme_mod('skycraft_serversign_port'), 2 );
				}
				catch( MinecraftPingException $e )
				{
					//echo $e->getMessage();
					$status = false;
					$statusImage = '/img/offline.png';
				}
				finally
				{
					if ($status) {
						$data = $query->Query();
						wp_cache_set($cacheKey, $data, '', 1 * 1);
						if( $query )
						{
							$query->Close();
						}
					}
				}
			}

			// Print Template
			echo '<div class="server-sign">' . PHP_EOL;
			echo '<div class="server-sign-inner mx-auto mb-2 mb-md-0 text-center">' . PHP_EOL;
			echo '<p class="mb-0">' . get_theme_mod('skycraft_serversign_address') . '</p>' . PHP_EOL;
			echo '<img class="mx-auto d-block" src="' . get_template_directory_uri() . $statusImage . '" />' . PHP_EOL;
			if ($status) {
				echo '<p class="mb-1">';
				//if (get_theme_mod('skycraft_serversign_favicon_enabled')) echo '<img src="' . $data['favicon'] . '" />&nbsp;';
				if (get_theme_mod('skycraft_serversign_description_enabled')) {
					if (isset($data['description']['extra']) && count($data['description']['extra'])) foreach ($data['description']['extra'] as $element) {
						echo '<font color="' . $element['color'] . '">' . $element['text'] . '</font>';
					}
					echo $data['description']['text'];
				}
				echo '</p>' . PHP_EOL;
				if (get_theme_mod('skycraft_serversign_players_enabled')) echo '<p class="mb-0">' . __('Spieler', 'skycraft') . ': ' . $data['players']['online'] . '/' . $data['players']['max'] . '</span>' . PHP_EOL;
				if (get_theme_mod('skycraft_serversign_version_enabled')) echo '<p class="mb-0">' . __('Version', 'skycraft') . ': ' . $data['version']['name'] . '</span>' . PHP_EOL;
			}
			echo '</div>' . PHP_EOL;
			echo '</div>' . PHP_EOL;
		}
	}
}