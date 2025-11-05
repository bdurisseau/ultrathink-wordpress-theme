<?php
/**
 * Index Template — Universal Fallback
 *
 * The most flexible template.
 * Displays posts when no more specific template is available.
 *
 * @package LotsOfHelp
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-content">
	<div class="container">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header class="page-header">
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<div class="posts-list">
				<?php
				while ( have_posts() ) :
					the_post();
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
						<header class="entry-header">
							<?php
							the_title( '<h2 class="post-card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
							?>

							<div class="entry-meta">
								<time class="published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
									<?php echo esc_html( get_the_date() ); ?>
								</time>
								<span class="reading-time">
									<?php echo esc_html( lotsofhelp_reading_time() ); ?>
								</span>
							</div>
						</header>

						<?php if ( has_post_thumbnail() ) : ?>
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'large' ); ?>
								</a>
							</div>
						<?php endif; ?>

						<div class="post-card-excerpt">
							<?php the_excerpt(); ?>
						</div>

						<a href="<?php the_permalink(); ?>" class="read-more">
							<?php esc_html_e( 'Read the story', 'lotsofhelp' ); ?> &rarr;
						</a>
					</article>

				<?php endwhile; ?>
			</div>

			<?php lotsofhelp_pagination(); ?>

		<?php else : ?>

			<div class="no-posts">
				<h1><?php esc_html_e( 'Nothing Found', 'lotsofhelp' ); ?></h1>
				<p><?php esc_html_e( 'No stories have been shared yet. Check back soon.', 'lotsofhelp' ); ?></p>
			</div>

		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
