<?php
/**
 * skycraft enqueue scripts
 *
 * @package skycraft
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'skycraft_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function skycraft_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		wp_enqueue_style( 'skycraft-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );
		wp_enqueue_style( 'google-font-londrina', 'https://fonts.googleapis.com/css?family=Londrina+Solid:900&display=swap' );
		wp_enqueue_style( 'google-font-pressstart2', 'https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap');

		wp_enqueue_script( 'jquery' );

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/theme.min.js' );
		wp_enqueue_script( 'skycraft-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'skycraft_scripts' ).

add_action( 'wp_enqueue_scripts', 'skycraft_scripts' );
