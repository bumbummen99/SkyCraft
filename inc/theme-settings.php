<?php
/**
 * Check and setup theme's default settings
 *
 * @package skycraft
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'understrap_setup_theme_default_settings' ) ) {
	function understrap_setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$understrap_posts_index_style = get_theme_mod( 'understrap_posts_index_style' );
		if ( '' == $understrap_posts_index_style ) {
			set_theme_mod( 'understrap_posts_index_style', 'default' );
		}

		// Sidebar position.
		$understrap_sidebar_position = get_theme_mod( 'understrap_sidebar_position' );
		if ( '' == $understrap_sidebar_position ) {
			set_theme_mod( 'understrap_sidebar_position', 'right' );
		}

		// Container width.
		$understrap_container_type = get_theme_mod( 'understrap_container_type' );
		if ( '' == $understrap_container_type ) {
			set_theme_mod( 'understrap_container_type', 'container' );
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
