<?php
/**
 * Custom hooks.
 *
 * @package skycraft
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'skycraft_site_info' ) ) {
	/**
	 * Add site info hook to WP hook library.
	 */
	function skycraft_site_info() {
		do_action( 'skycraft_site_info' );
	}
}

if ( ! function_exists( 'skycraft_add_site_info' ) ) {
	add_action( 'skycraft_site_info', 'skycraft_add_site_info' );

	/**
	 * Add site info content.
	 */
	function skycraft_add_site_info() {
		$the_theme = wp_get_theme();

		$site_info = sprintf(
			'<a href="%1$s">%2$s</a><span class="sep"> | </span>%3$s',
			esc_url( __( 'http://wordpress.org/', 'skycraft' ) ),
			sprintf(
				/* translators:*/
				esc_html__( 'Proudly powered by %s', 'skycraft' ),
				'WordPress'
			),
			sprintf( // WPCS: XSS ok.
				/* translators:*/
				esc_html__( 'Theme: %1$s by %2$s.', 'skycraft' ),
				$the_theme->get( 'Name' ),
				'<a href="' . esc_url( __( 'http://skyraptor.eu', 'skycraft' ) ) . '">SkyRaptor</a>'
			)
		);

		echo apply_filters( 'skycraft_site_info_content', $site_info ); // WPCS: XSS ok.
	}
}
