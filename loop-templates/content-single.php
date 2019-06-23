<?php
/**
 * Single post partial template.
 *
 * @package skycraft
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="post-wrapper mb-3">
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-inner">

		<header class="entry-header">

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<div class="entry-meta">

				<?php skycraft_posted_on(); ?>

			</div><!-- .entry-meta -->

		</header><!-- .entry-header -->

		<?php echo get_the_post_thumbnail( $post->ID ); ?>

		<div class="entry-content">

			<?php the_content(); ?>

			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'skycraft' ),
					'after'  => '</div>',
				)
			);
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">

			<?php skycraft_entry_footer(); ?>

		</footer><!-- .entry-footer -->
	
	</div>

</article><!-- #post-## -->
<div class="block-bottom">
	<span class="left"></span>
	<span class="middle">
		<span></span>
	</span>
	<span class="right"></span>
</div>
</div>