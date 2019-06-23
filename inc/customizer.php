<?php
/**
 * skycraft Theme Customizer
 *
 * @package skycraft
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'skycraft_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function skycraft_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'skycraft_customize_register' );

if ( ! function_exists( 'skycraft_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function skycraft_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'skycraft_theme_layout_options',
			array(
				'title'       => __( 'Theme Layout Settings', 'skycraft' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'skycraft' ),
				'priority'    => 160,
			)
		);

		// Theme layout settings.
		$wp_customize->add_section(
			'skycraft_theme_serversign_options',
			array(
				'title'       => __( 'ServerSign Settings', 'skycraft' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'skycraft' ),
				'priority'    => 160,
			)
		);

		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		function skycraft_theme_slug_sanitize_select( $input, $setting ) {

			// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
			$input = sanitize_key( $input );

			// Get the list of possible select options.
			$choices = $setting->manager->get_control( $setting->id )->choices;

				// If the input is a valid key, return it; otherwise, return the default.
				return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

		}

		function skycraft_theme_slug_sanitize_checkbox( $checked ) {
			// Boolean check.
			return ( ( isset( $checked ) && true == $checked ) ? true : false );
		}

		// Server Sign
		$wp_customize->add_setting( 'skycraft_serversign_enabled', [
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'skycraft_theme_slug_sanitize_checkbox',
		]);
		  
		$wp_customize->add_control( 'skycraft_serversign_enabled', [
			'type' => 'checkbox',
			'section' => 'skycraft_theme_serversign_options', // Add a default or your own section
			'label' => __( 'Enable Server Sign' ),
			'description' => __( 'Enables the Server Sign functionality in the Header.' ),
		]);

		// Server Sign Server Description
		$wp_customize->add_setting( 'skycraft_serversign_description_enabled', [
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'skycraft_theme_slug_sanitize_checkbox',
		]);
		  
		$wp_customize->add_control( 'skycraft_serversign_description_enabled', [
			'type' => 'checkbox',
			'section' => 'skycraft_theme_serversign_options', // Add a default or your own section
			'label' => __( 'ServerSign Description' ),
			'description' => __( 'Enables the server description in the Server Sign.' ),
		]);

		// Server Sign Server Icon
		/*$wp_customize->add_setting( 'skycraft_serversign_favicon_enabled', [
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'skycraft_theme_slug_sanitize_checkbox',
		]);
		  
		$wp_customize->add_control( 'skycraft_serversign_favicon_enabled', [
			'type' => 'checkbox',
			'section' => 'skycraft_theme_serversign_options',
			'label' => __( 'ServerSign Icon' ),
			'description' => __( 'Enables the server icon in the Server Sign.' ),
		]);*/

		// Server Sign Players
		$wp_customize->add_setting( 'skycraft_serversign_players_enabled', [
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'skycraft_theme_slug_sanitize_checkbox',
		]);
		  
		$wp_customize->add_control( 'skycraft_serversign_players_enabled', [
			'type' => 'checkbox',
			'section' => 'skycraft_theme_serversign_options', // Add a default or your own section
			'label' => __( 'ServerSign Players' ),
			'description' => __( 'Enables the server players in the Server Sign.' ),
		]);

		// Server Sign Version
		$wp_customize->add_setting( 'skycraft_serversign_version_enabled', [
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'skycraft_theme_slug_sanitize_checkbox',
		]);
		  
		$wp_customize->add_control( 'skycraft_serversign_version_enabled', [
			'type' => 'checkbox',
			'section' => 'skycraft_theme_serversign_options', // Add a default or your own section
			'label' => __( 'ServerSign Version' ),
			'description' => __( 'Enables the server version in the Server Sign.' ),
		]);

		// Server Sign address
		$wp_customize->add_setting( 'skycraft_serversign_address', array(
			'capability' => 'edit_theme_options',
			'default' => 'test.nitrado.net',
			'sanitize_callback' => 'sanitize_text_field',
		));
		  
		  $wp_customize->add_control( 'skycraft_serversign_address', array(
			'type' => 'text',
			'section' => 'skycraft_theme_serversign_options', // Add a default or your own section
			'label' => __( 'ServerSign Address' ),
			'description' => __( 'Defines the server address for the Server Sign.' ),
		));

		// Server Sign Port
		$wp_customize->add_setting( 'skycraft_serversign_port', array(
			'capability' => 'edit_theme_options',
			'default' => '25565',
			'sanitize_callback' => 'sanitize_text_field',
		));
		  
		  $wp_customize->add_control( 'skycraft_serversign_port', array(
			'type' => 'text',
			'section' => 'skycraft_theme_serversign_options', // Add a default or your own section
			'label' => __( 'ServerSign Port' ),
			'description' => __( 'Defines the server port for the Server Sign.' ),
		));

		$wp_customize->add_setting(
			'skycraft_container_type',
			array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'skycraft_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'skycraft_container_type',
				array(
					'label'       => __( 'Container Width', 'skycraft' ),
					'description' => __( 'Choose between Bootstrap\'s container and container-fluid', 'skycraft' ),
					'section'     => 'skycraft_theme_layout_options',
					'settings'    => 'skycraft_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'skycraft' ),
						'container-fluid' => __( 'Full width container', 'skycraft' ),
					),
					'priority'    => '10',
				)
			)
		);

		$wp_customize->add_setting(
			'skycraft_sidebar_position',
			array(
				'default'           => 'right',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'skycraft_sidebar_position',
				array(
					'label'             => __( 'Sidebar Positioning', 'skycraft' ),
					'description'       => __(
						'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
						'skycraft'
					),
					'section'           => 'skycraft_theme_layout_options',
					'settings'          => 'skycraft_sidebar_position',
					'type'              => 'select',
					'sanitize_callback' => 'skycraft_theme_slug_sanitize_select',
					'choices'           => array(
						'right' => __( 'Right sidebar', 'skycraft' ),
						'left'  => __( 'Left sidebar', 'skycraft' ),
						'both'  => __( 'Left & Right sidebars', 'skycraft' ),
						'none'  => __( 'No sidebar', 'skycraft' ),
					),
					'priority'          => '20',
				)
			)
		);
	}
} // endif function_exists( 'skycraft_theme_customize_register' ).
add_action( 'customize_register', 'skycraft_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'skycraft_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function skycraft_customize_preview_js() {
		wp_enqueue_script(
			'skycraft_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ),
			'20130508',
			true
		);
	}
}
add_action( 'customize_preview_init', 'skycraft_customize_preview_js' );
