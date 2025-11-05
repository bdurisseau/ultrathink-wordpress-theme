<?php
/**
 * Front Page Template — The First Impression
 *
 * This is where people arrive. Make it count.
 * No wasted space. No redundant titles. Just your story, told beautifully.
 *
 * This template is used when you have a static front page set in:
 * Settings → Reading → "A static page"
 *
 * @package LotsOfHelp
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-content front-page-content">
	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'front-page-article' ); ?>>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="front-page-hero">
					<div class="container">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="container">
				<div class="front-page-content-wrapper">
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
		// Comments on the homepage? Only if you want them.
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
