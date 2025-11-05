<?php
/**
 * Single Post Template — Focused Reading Experience
 *
 * Every story deserves undivided attention.
 * No distractions. Just the narrative.
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

					<div class="entry-meta">
						<time class="published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
							<?php echo esc_html( get_the_date() ); ?>
						</time>
						<span class="reading-time">
							<?php echo esc_html( lotsofhelp_reading_time() ); ?>
						</span>
						<?php
						$categories = get_the_category();
						if ( ! empty( $categories ) ) :
							?>
							<span class="category">
								<?php echo esc_html( $categories[0]->name ); ?>
							</span>
						<?php endif; ?>
					</div>
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

				<?php
				$tags = get_the_tags();
				if ( $tags ) :
					?>
					<footer class="entry-footer">
						<div class="tags">
							<?php
							foreach ( $tags as $tag ) {
								echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">#' . esc_html( $tag->name ) . '</a> ';
							}
							?>
						</div>
					</footer>
				<?php endif; ?>
			</div>
		</article>

		<div class="container">
			<?php lotsofhelp_post_navigation(); ?>

			<?php
			// If comments are open or there's at least one comment, load the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
		</div>

	<?php endwhile; ?>
</main>

<?php
get_footer();
