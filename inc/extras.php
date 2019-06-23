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
			<div class="row nav-links justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', 'skycraft' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<span class="nav-next">%link</span>', _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', 'skycraft' ) );
				}
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
			echo '<div class="server-sign mx-auto mb-2 mb-md-0 text-center">' . PHP_EOL;
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
				if (get_theme_mod('skycraft_serversign_players_enabled')) echo '<p class="mb-0">' . __('Spieler') . ': ' . $data['players']['online'] . '/' . $data['players']['max'] . '</span>' . PHP_EOL;
				if (get_theme_mod('skycraft_serversign_version_enabled')) echo '<p class="mb-0">' . __('Version') . ': ' . $data['version']['name'] . '</span>' . PHP_EOL;
			}
			echo '</div>' . PHP_EOL;
		}
	}
}


// Create Post Type for the In Person Assessment Logging

function skycraft_dynmap_create_post_type() {

	/* Set up the arguments for the post type. */
	$args = array(

		/**
		 * A short description of what your post type is. As far as I know, this isn't used anywhere
		 * in core WordPress.  However, themes may choose to display this on post type archives.
		 */
		'skycraft_dynmap' => __( 'Store and Manage In Person Grades.', 'skycraft-dynmap' ), // string

		/**
		 * Whether the post type should be used publicly via the admin or by front-end users.  This
		 * argument is sort of a catchall for many of the following arguments.  I would focus more
		 * on adjusting them to your liking than this argument.
		 */
		'public'              => true, // bool (default is FALSE)

		/**
		 * Whether queries can be performed on the front end as part of parse_request().
		 */
		'publicly_queryable'  => true, // bool (defaults to 'public').

		/**
		 * Whether to exclude posts with this post type from front end search results.
		 */
		'exclude_from_search' => false, // bool (defaults to 'public')

		/**
		 * Whether individual post type items are available for selection in navigation menus.
		 */
		'show_in_nav_menus'   => false, // bool (defaults to 'public')

		/**
		 * Whether to generate a default UI for managing this post type in the admin. You'll have
		 * more control over what's shown in the admin with the other arguments.  To build your
		 * own UI, set this to FALSE.
		 */
		'show_ui'             => true, // bool (defaults to 'public')

		/**
		 * Whether to show post type in the admin menu. 'show_ui' must be true for this to work.
		 */
		'show_in_menu'        => true, // bool (defaults to 'show_ui')

		/**
		 * Whether to make this post type available in the WordPress admin bar. The admin bar adds
		 * a link to add a new post type item.
		 */
		'show_in_admin_bar'   => true, // bool (defaults to 'show_in_menu')

		/**
		 * The position in the menu order the post type should appear. 'show_in_menu' must be true
		 * for this to work.
		 */
		'menu_position'       => null, // int (defaults to 25 - below comments)

		/**
		 * The URI to the icon to use for the admin menu item. There is no header icon argument, so
		 * you'll need to use CSS to add one.
		 */
		'menu_icon'           => 'dashicons-clipboard', // string (defaults to use the post icon)

		/**
		 * Whether the posts of this post type can be exported via the WordPress import/export plugin
		 * or a similar plugin.
		 */
		'can_export'          => true, // bool (defaults to TRUE)

		/**
		 * Whether to delete posts of this type when deleting a user who has written posts.
		 */
		'delete_with_user'    => false, // bool (defaults to TRUE if the post type supports 'author')

		/**
		 * Whether this post type should allow hierarchical (parent/child/grandchild/etc.) posts.
		 */
		'hierarchical'        => false, // bool (defaults to FALSE)

		/**
		 * Whether the post type has an index/archive/root page like the "page for posts" for regular
		 * posts. If set to TRUE, the post type name will be used for the archive slug.  You can also
		 * set this to a string to control the exact name of the archive slug.
		 */
		'has_archive'         => 'skycraft-dynmap', // bool|string (defaults to FALSE)

		/**
		 * Sets the query_var key for this post type. If set to TRUE, the post type name will be used.
		 * You can also set this to a custom string to control the exact key.
		 */
		'query_var'           => 'skycraft_dynmap', // bool|string (defaults to TRUE - post type name)

		/**
		 * A string used to build the edit, delete, and read capabilities for posts of this type. You
		 * can use a string or an array (for singular and plural forms).  The array is useful if the
		 * plural form can't be made by simply adding an 's' to the end of the word.  For example,
		 * array( 'box', 'boxes' ).
		 */
		'capability_type'     => 'skycraft_dynmap', // string|array (defaults to 'post')

		/**
		 * Whether WordPress should map the meta capabilities (edit_post, read_post, delete_post) for
		 * you.  If set to FALSE, you'll need to roll your own handling of this by filtering the
		 * 'map_meta_cap' hook.
		 */
		'map_meta_cap'        => true, // bool (defaults to FALSE)

		/**
		 * Provides more precise control over the capabilities than the defaults.  By default, WordPress
		 * will use the 'capability_type' argument to build these capabilities.  More often than not,
		 * this results in many extra capabilities that you probably don't need.  The following is how
		 * I set up capabilities for many post types, which only uses three basic capabilities you need
		 * to assign to roles: 'manage_examples', 'edit_examples', 'create_examples'.  Each post type
		 * is unique though, so you'll want to adjust it to fit your needs.
		 */
		'capabilities'        => array(

			// meta caps (don't assign these to roles)
			'edit_post'              => 'edit_skycraft_dynmap',
			'read_post'              => 'read_skycraft_dynmap',
			'delete_post'            => 'delete_skycraft_dynmap',

			// primitive/meta caps
			'create_posts'           => 'create_skycraft_dynmap',

			// primitive caps used outside of map_meta_cap()
			'edit_posts'             => 'edit_skycraft_dynmap',
			'edit_others_posts'      => 'manage_skycraft_dynmap',
			'publish_posts'          => 'manage_skycraft_dynmap',
			'read_private_posts'     => 'read',

			// primitive caps used inside of map_meta_cap()
			'read'                   => 'read',
			'delete_posts'           => 'manage_skycraft_dynmap',
			'delete_private_posts'   => 'manage_skycraft_dynmap',
			'delete_published_posts' => 'manage_skycraft_dynmap',
			'delete_others_posts'    => 'manage_skycraft_dynmap',
			'edit_private_posts'     => 'edit_skycraft_dynmap',
			'edit_published_posts'   => 'edit_skycraft_dynmap'
		),

		/**
		 * How the URL structure should be handled with this post type.  You can set this to an
		 * array of specific arguments or true|false.  If set to FALSE, it will prevent rewrite
		 * rules from being created.
		 */
		'rewrite'             => array(

			/* The slug to use for individual posts of this type. */
			'slug'       => 'skycraft_dynmap', // string (defaults to the post type name)

			/* Whether to show the $wp_rewrite->front slug in the permalink. */
			'with_front' => false, // bool (defaults to TRUE)

			/* Whether to allow single post pagination via the <!--nextpage--> quicktag. */
			'pages'      => true, // bool (defaults to TRUE)

			/* Whether to create feeds for this post type. */
			'feeds'      => true, // bool (defaults to the 'has_archive' argument)

			/* Assign an endpoint mask to this permalink. */
			'ep_mask'    => EP_PERMALINK, // const (defaults to EP_PERMALINK)
		),

		/**
		 * What WordPress features the post type supports.  Many arguments are strictly useful on
		 * the edit post screen in the admin.  However, this will help other themes and plugins
		 * decide what to do in certain situations.  You can pass an array of specific features or
		 * set it to FALSE to prevent any features from being added.  You can use
		 * add_post_type_support() to add features or remove_post_type_support() to remove features
		 * later.  The default features are 'title' and 'editor'.
		 */
		'supports'            => array(

			/* Post titles ($post->post_title). */
			'title',

			/* Post content ($post->post_content). */
			'editor',

			/* Post excerpt ($post->post_excerpt). */
			'excerpt',

			/* Post author ($post->post_author). */
			'author',

			/* Featured images (the user's theme must support 'post-thumbnails'). */
			'thumbnail',

			/* Displays comments meta box.  If set, comments (any type) are allowed for the post. */
			'comments',

			/* Displays meta box to send trackbacks from the edit post screen. */
			'trackbacks',

			/* Displays the Custom Fields meta box. Post meta is supported regardless. */
			'custom-fields',

			/* Displays the Revisions meta box. If set, stores post revisions in the database. */
			'revisions',

			/* Displays the Attributes meta box with a parent selector and menu_order input box. */
			'page-attributes',

			/* Displays the Format meta box and allows post formats to be used with the posts. */
			'post-formats',
		),

		/**
		 * Labels used when displaying the posts in the admin and sometimes on the front end.  These
		 * labels do not cover post updated, error, and related messages.  You'll need to filter the
		 * 'post_updated_messages' hook to customize those.
		 */

		'labels' => array(
			'name'               => __( 'In Person Assessments', 'skycraft-dynmaps' ),
			'singular_name'      => __( 'In Person Assessment', 'skycraft-dynmaps' ),
			'menu_name'          => __( 'In Person Assessments', 'skycraft-dynmaps' ),
			'name_admin_bar'     => __( 'In Person Assessments', 'skycraft-dynmaps' ),
			'add_new'            => __( 'Add New', 'skycraft-dynmaps' ),
			'add_new_item'       => __( 'Add New Assessment', 'skycraft-dynmaps' ),
			'edit_item'          => __( 'Edit', 'skycraft-dynmaps' ),
			'new_item'           => __( 'New Item', 'skycraft-dynmaps' ),
			'view_item'          => __( 'View In Person Assessment', 'skycraft-dynmaps' ),
			'search_items'       => __( 'Search In Person Assessments', 'skycraft-dynmaps' ),
			'not_found'          => __( 'No Assessments found', 'skycraft-dynmaps' ),
			'not_found_in_trash' => __( 'No Assessments found in trash', 'eskycraft-dynmaps' ),
			'all_items'          => __( 'All In Person Assessments', 'skycraft-dynmaps' ),


			/* Custom archive label.  Must filter 'post_type_archive_title' to use. */
			'archive_title'      => __( 'In Person Assessments', 'skycraft-dynmaps' ),
		)
	);

	/* Register the post type. */
	register_post_type(
		'skycraft-dynmap', // Post type name. Max of 20 characters. Uppercase and spaces not allowed.
		$args      // Arguments for post type.
	);
}

add_action('init', 'skycraft_dynmap_create_post_type');