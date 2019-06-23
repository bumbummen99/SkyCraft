<?php
/**
 * Search results partial template.
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

			<?php
			the_title(
				sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
				'</a></h2>'
			);
			?>

			<?php if ( 'post' == get_post_type() ) : ?>

				<div class="entry-meta">

					<?php skycraft_posted_on(); ?>

				</div><!-- .entry-meta -->

			<?php endif; ?>

		</header><!-- .entry-header -->

		<div class="entry-summary">

			<?php the_excerpt(); ?>

		</div><!-- .entry-summary -->

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