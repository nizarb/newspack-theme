<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newspack
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<?php

		// Footer widgets
		$footer_id = get_theme_mod( 'page_for_footer_widgets' );
		if ( $footer_id ) {
			get_template_part( 'template-parts/footer/site', 'footer-widgets-from-page' );
		} else {
			get_template_part( 'template-parts/footer/footer', 'widgets' );
		}

		// Site info
		$site_info_id = get_theme_mod( 'page_for_siteinfo' );
		if ( $site_info_id ) {
			get_template_part( 'template-parts/footer/site', 'footer-info-from-page' );
		} else {
		?>
			<div class="site-info">
				<?php $blog_info = get_bloginfo( 'name' ); ?>
				<?php if ( ! empty( $blog_info ) ) : ?>
					<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a><span class="comma">,</span>
				<?php endif; ?>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'newspack' ) ); ?>" class="imprint">
					<?php
					/* translators: %s: WordPress. */
					printf( esc_html__( 'Proudly powered by %s.', 'newspack' ), 'WordPress' );
					?>
				</a>
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '', '<span role="separator" aria-hidden="true"></span>' );
				}
				?>
				<?php if ( has_nav_menu( 'footer' ) ) : ?>
					<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'newspack' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'menu_class'     => 'footer-menu',
								'depth'          => 1,
							)
						);
						?>
					</nav><!-- .footer-navigation -->
				<?php endif; ?>
			</div><!-- .site-info -->

		<?php
		}
		?>

	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
