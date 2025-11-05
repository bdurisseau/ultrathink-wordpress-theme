<?php
/**
 * Footer Template — Grounding Element
 *
 * The end of every page, but not the end of the journey.
 *
 * @package LotsOfHelp
 * @since 1.0.0
 */
?>

	</div><!-- #content -->

	<footer class="site-footer">
		<div class="container">
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<div class="footer-widgets">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
			<?php endif; ?>

			<div class="site-info">
				<?php
				printf(
					/* translators: %s: site name */
					esc_html__( '%s — Honoring the networks of support that create breakthroughs', 'lotsofhelp' ),
					'<strong>' . get_bloginfo( 'name' ) . '</strong>'
				);
				?>
				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Navigation', 'lotsofhelp' ); ?>">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'footer',
							'menu_class'     => 'footer-menu',
							'container'      => false,
							'depth'          => 1,
						) );
						?>
					</nav>
				<?php endif; ?>
			</div>
		</div>
	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
