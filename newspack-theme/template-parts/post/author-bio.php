<?php
/**
 * The template for displaying Author info
 *
 * @package Newspack
 */

$author_bio_length = get_theme_mod( 'author_bio_length', 200 );

if ( function_exists( 'coauthors_posts_links' ) && is_single() ) :

	$authors      = get_coauthors();
	$author_count = count( $authors );
	$i            = 1;

	foreach ( $authors as $author ) {

		if ( '' !== $author->description ) {

			if ( 'guest-author' === get_post_type( $author->ID ) ) {
				if ( get_post_thumbnail_id( $author->ID ) ) {
					$author_avatar = coauthors_get_avatar( $author, 80 );
				} else {
					// If there is no avatar, force it to return the current fallback image.
					$author_avatar = get_avatar( ' ' );
				}
			} else {
				$author_avatar = coauthors_get_avatar( $author, 80 );
			}
			?>

			<div class="author-bio">
				<?php
				if ( ! newspack_is_active_style_pack( 'style-4' ) && $author_avatar ) {
					echo wp_kses( $author_avatar, newspack_sanitize_avatars() );
				}
				?>

				<div class="author-bio-text">
					<div class="author-bio-header">
						<?php
						if ( newspack_is_active_style_pack( 'style-4' ) && $author_avatar ) {
							echo wp_kses( $author_avatar, newspack_sanitize_avatars() );
						}
						?>

						<div>
							<h2 class="accent-header">
								<?php echo esc_html( esc_html( $author->display_name ) ); ?>
								<span><?php // TODO: Add Job title ?></span>
							</h2>
							<div class="author-meta">
								<a class="author-email" href="<?php echo 'mailto:' . esc_attr( $author->user_email ); ?>"><?php echo esc_html( $author->user_email ); ?></a>
							</div>
						</div>
					</div><!-- .author-bio-header -->

					<?php if ( get_theme_mod( 'author_bio_truncate', true ) ) : ?>
						<p>
							<?php echo esc_html( wp_strip_all_tags( newspack_truncate_text( $author->description, $author_bio_length ) ) ); ?>
							<a class="author-link" href="<?php echo esc_url( get_author_posts_url( $author->ID, $author->user_nicename ) ); ?>" rel="author">
							<?php
								/* translators: %s is the current author's name. */
								printf( esc_html__( 'More by %s', 'newspack' ), esc_html( $author->display_name ) );
							?>
							</a>
						</p>
					<?php else : ?>
						<?php echo wp_kses_post( wpautop( $author->description ) ); ?>

						<a class="author-link" href="<?php echo esc_url( get_author_posts_url( $author->ID, $author->user_nicename ) ); ?>" rel="author">
							<?php
								/* translators: %s is the current author's name. */
								printf( esc_html__( 'More by %s', 'newspack' ), esc_html( $author->display_name ) );
							?>
						</a>
					<?php endif; ?>

				</div><!-- .author-bio-text -->

			</div><!-- .author-bio -->
		<?php
		}
	}

elseif ( (bool) get_the_author_meta( 'description' ) && is_single() ) :
?>

<div class="author-bio">

	<?php
	if ( ! newspack_is_active_style_pack( 'style-4' ) ) {
		$author_avatar = get_avatar( get_the_author_meta( 'ID' ), 80 );
		if ( $author_avatar ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo $author_avatar;
		}
	}
	?>

	<div class="author-bio-text">
		<div class="author-bio-header">
			<?php
			if ( newspack_is_active_style_pack( 'style-4' ) ) {
				$author_avatar = get_avatar( get_the_author_meta( 'ID' ), 80 );
				if ( $author_avatar ) {
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo $author_avatar;
				}
			}
			?>

			<div>
				<h2 class="accent-header">
					<?php echo esc_html( get_the_author() ); ?>
					<span><?php // TODO: Add Job title ?></span>
				</h2>
				<div class="author-meta">
					<a class="author-email" href="<?php echo 'mailto:' . esc_attr( get_the_author_meta( 'user_email' ) ); ?>"><?php the_author_meta( 'user_email' ); ?></a>
				</div>
			</div>
		</div><!-- .author-bio-header -->

		<?php if ( get_theme_mod( 'author_bio_truncate', true ) ) : ?>
			<p>
				<?php echo esc_html( wp_strip_all_tags( newspack_truncate_text( get_the_author_meta( 'description' ), $author_bio_length ) ) ); ?>
				<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php
					/* translators: %s is the current author's name. */
					printf( esc_html__( 'More by %s', 'newspack' ), esc_html( get_the_author() ) );
				?>
				</a>
			</p>
		<?php else : ?>
			<?php echo wp_kses_post( wpautop( get_the_author_meta( 'description' ) ) ); ?>

			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( $author->ID, $author->user_nicename ) ); ?>" rel="author">
				<?php
					/* translators: %s is the current author's name. */
					printf( esc_html__( 'More by %s', 'newspack' ), esc_html( get_the_author() ) );
				?>
			</a>
		<?php endif; ?>

	</div><!-- .author-bio-text -->
</div><!-- .author-bio -->
<?php endif; ?>
