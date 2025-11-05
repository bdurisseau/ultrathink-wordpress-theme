<?php
/**
 * Page Template — Timeless Content
 *
 * For content that doesn't change often.
 * About pages. Contact forms. Evergreen resources.
 *
 * @package LotsOfHelp
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-content">
	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="container">
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>

				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'lotsofhelp' ),
						'after'  => '</div>',
					) );
					?>
				</div>
			</div>
		</article>

		<?php
		// If comments are open or there's at least one comment, load the comment template.
		if ( comments_open() || get_comments_number() ) :
			?>
			<div class="container">
				<?php comments_template(); ?>
			</div>
		<?php endif; ?>

	<?php endwhile; ?>
</main>

<?php
get_footer();
