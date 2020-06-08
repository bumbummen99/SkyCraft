<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package skycraft
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod( 'skycraft_container_type' );
?>
<div class="wrapper" id="error-404-wrapper">
	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
		<div class="row">
			<div class="col-md-12 content-area" id="primary">
				<main class="site-main" id="main">
					<section class="error-404 not-found">
						<div class="page-inner">
							<header class="page-header">
								<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'skycraft' ); ?></h1>
							</header><!-- .page-header -->
							<div class="page-content">
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'skycraft' ); ?></p>
								<div class="mb-3">
									<?php get_search_form(); ?>
								</div>
								<?php the_widget( 'WP_Widget_Recent_Posts', [], skycraft_widget_arguments() ); ?>
								<?php if ( skycraft_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
									<div class="widget widget_categories">
										<h3 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'skycraft' ); ?></h3>
										<ul>
											<?php
											wp_list_categories(
												array(
													'orderby'    => 'count',
													'order'      => 'DESC',
													'show_count' => 1,
													'title_li'   => '',
													'number'     => 10,
												)
											);
											?>
										</ul>
									</div><!-- .widget -->
								<?php endif; ?>
								<?php the_widget( 'WP_Widget_Archives', ['dropdown' => '1'], skycraft_widget_arguments() ); ?>
								<p class="text-center"><?= sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'skycraft' ), convert_smilies( ':)' ) ) ?></p>
								<?php the_widget( 'WP_Widget_Tag_Cloud', [], skycraft_widget_arguments() ); ?>
							</div><!-- .page-content -->
						</div>
					</section><!-- .error-404 -->
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .row -->
	</div><!-- #content -->
</div><!-- #error-404-wrapper -->
<?php get_footer(); ?>