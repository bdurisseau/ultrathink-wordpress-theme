<?php
/**
 * 404 Template — Elegant Error
 *
 * When someone gets lost, guide them back gently.
 * An error page should still feel human.
 *
 * @package LotsOfHelp
 * @since 1.0.0
 */

get_header();
?>

<main id="primary" class="site-content">
	<div class="container">
		<article class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Page Not Found', 'lotsofhelp' ); ?></h1>
			</header>

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like this page has wandered off, or perhaps it never existed.', 'lotsofhelp' ); ?></p>
				<p><?php esc_html_e( 'That\'s okay—sometimes the best discoveries come from taking unexpected paths.', 'lotsofhelp' ); ?></p>

				<h2><?php esc_html_e( 'Let\'s help you find your way:', 'lotsofhelp' ); ?></h2>

				<?php get_search_form(); ?>

				<h3><?php esc_html_e( 'Recent Stories', 'lotsofhelp' ); ?></h3>
				<?php
				$recent_posts = wp_get_recent_posts( array(
					'numberposts' => 5,
					'post_status' => 'publish',
				) );

				if ( $recent_posts ) :
					echo '<ul>';
					foreach ( $recent_posts as $recent_post ) :
						printf(
							'<li><a href="%1$s">%2$s</a></li>',
							esc_url( get_permalink( $recent_post['ID'] ) ),
							esc_html( $recent_post['post_title'] )
						);
					endforeach;
					echo '</ul>';
					wp_reset_postdata();
				endif;
				?>

				<p>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button">
						<?php esc_html_e( 'Return Home', 'lotsofhelp' ); ?>
					</a>
				</p>
			</div>
		</article>
	</div>
</main>

<?php
get_footer();
