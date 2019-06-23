<?php
/**
 * Check and setup theme's default settings
 *
 * @package skycraft
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'skycraft_setup_theme_default_settings' ) ) {
	function skycraft_setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$skycraft_posts_index_style = get_theme_mod( 'skycraft_posts_index_style' );
		if ( '' == $skycraft_posts_index_style ) {
			set_theme_mod( 'skycraft_posts_index_style', 'default' );
		}

		// Sidebar position.
		$skycraft_sidebar_position = get_theme_mod( 'skycraft_sidebar_position' );
		if ( '' == $skycraft_sidebar_position ) {
			set_theme_mod( 'skycraft_sidebar_position', 'right' );
		}

		// Container width.
		$skycraft_container_type = get_theme_mod( 'skycraft_container_type' );
		if ( '' == $skycraft_container_type ) {
			set_theme_mod( 'skycraft_container_type', 'container' );
		}

		// Container width.
		$skycraft_serversign_enabled = get_theme_mod( 'skycraft_serversign_enabled' );
		if ( '' == $skycraft_serversign_enabled ) {
			set_theme_mod( 'skycraft_serversign_enabled', true );
		}

		// Container width.
		$skycraft_serversign_description_enabled = get_theme_mod( 'skycraft_serversign_description_enabled' );
		if ( '' == $skycraft_serversign_description_enabled ) {
			set_theme_mod( 'skycraft_serversign_description_enabled', true );
		}

		// Container width.
		//$skycraft_serversign_favicon_enabled = get_theme_mod( 'skycraft_serversign_favicon_enabled' );
		//if ( '' == $skycraft_serversign_favicon_enabled ) {
		//	set_theme_mod( 'skycraft_serversign_favicon_enabled', true );
		//}

		// Container width.
		$skycraft_serversign_players_enabled = get_theme_mod( 'skycraft_serversign_players_enabled' );
		if ( '' == $skycraft_serversign_players_enabled ) {
			set_theme_mod( 'skycraft_serversign_players_enabled', true );
		}

		// Container width.
		$skycraft_serversign_version_enabled = get_theme_mod( 'skycraft_serversign_version_enabled' );
		if ( '' == $skycraft_serversign_version_enabled ) {
			set_theme_mod( 'skycraft_serversign_version_enabled', true );
		}

		// Container width.
		$skycraft_serversign_address = get_theme_mod( 'skycraft_serversign_address' );
		if ( '' == $skycraft_serversign_address ) {
			set_theme_mod( 'skycraft_serversign_address', 'test.nitrado.net' );
		}

		// Container width.
		$skycraft_serversign_port = get_theme_mod( 'skycraft_serversign_port' );
		if ( '' == $skycraft_serversign_port ) {
			set_theme_mod( 'skycraft_serversign_port', 25565 );
		}
	}
}
