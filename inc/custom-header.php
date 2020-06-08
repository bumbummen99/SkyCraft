<?php
/**
 * Custom header setup.
 *
 * @package skycraft
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'after_setup_theme', 'skycraft_custom_header_setup' );

if ( ! function_exists( 'skycraft_custom_header_setup' ) ) {
	function skycraft_custom_header_setup() {

		/**
		 * Filter skycraft custom-header support arguments.
		 *
		 * @since skycraft 0.5.2
		 *
		 * @param array $args {
		 *     An array of custom-header support arguments.
		 *
		 *     @type string $default-image          Default image of the header.
		 *     @type string $default_text_color     Default color of the header text.
		 *     @type int    $width                  Width in pixels of the custom header image. Default 954.
		 *     @type int    $height                 Height in pixels of the custom header image. Default 1300.
		 *     @type string $wp-head-callback       Callback function used to styles the header image and text
		 *                                          displayed on the blog.
		 *     @type string $flex-height            Flex support for height of header.
		 * }
		 */
		add_theme_support(
			'custom-header',
			[
				'default-image' => get_template_directory_uri() . '/img/header.jpg',
				'width'         => 1920,
				'height'        => 1080,
				'flex-height'   => true,
			]
		);

		register_default_headers(
			array(
				'default-image' => array(
					'url'           => '%s/img/header.jpg',
					'thumbnail_url' => '%s/img/header.jpg',
					'description'   => __( 'Default Header Image', 'skycraft' ),
				),
			)
		);
	}
}
